<?php
include 'db_connection.php'; 

session_start();
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your orders.");
}

$user_id = $_SESSION['user_id']; 
$query = "SELECT purchases.*, books.name, book_images.image_path 
          FROM purchases 
          JOIN books ON purchases.book_id = books.book_id 
          LEFT JOIN book_images ON books.book_id = book_images.book_id 
          WHERE purchases.user_id = ?";

$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $orders = mysqli_stmt_get_result($stmt);
} else {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .order-card:hover {
            transform: scale(1.03);
        }
        .order-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px 0 0 10px;
        }
        .order-details {
            padding: 15px;
        }
        .order-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .order-date {
            font-size: 14px;
            color: #777;
        }
        .cancel-btn {
            font-size: 14px;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }
        .cancel-btn:hover {
            background-color: #dc3545;
            color: white;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #000;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            text-align: center;
            line-height: 25px;
            cursor: pointer;
        }
        .close-btn:hover {
            background: red;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Your Orders</h2>
    <a href="../user/index.php" class="close-btn">&times;</a>
    <div class="row">
        <?php if (mysqli_num_rows($orders) > 0): ?>
            <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm order-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= !empty($order['image_path']) ? htmlspecialchars($order['image_path']) : 'default.jpg'; ?>" 
                                     class="img-fluid order-img" 
                                     alt="<?= htmlspecialchars($order['name']); ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body order-details">
                                    <h5 class="order-title">Book: <?= htmlspecialchars($order['name']); ?></h5>
                                    <p class="order-date">Purchase Date: <?= htmlspecialchars($order['purchase_date']); ?></p>
                                    <button class="btn btn-outline-danger cancel-btn" data-bs-toggle="modal" data-bs-target="#cancelModal" data-order-id="<?= $order['purchase_id']; ?>">Cancel Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">No orders found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="cancelModalLabel">Confirm Cancellation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="#" id="confirmCancel" class="btn btn-danger">Yes, Cancel</a>
            </div>
        </div>
    </div>
</div>

<script>
    var cancelModal = document.getElementById('cancelModal');
    cancelModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var orderId = button.getAttribute('data-order-id');
        var confirmCancel = document.getElementById('confirmCancel');
        confirmCancel.href = 'cancel_order.php?order_id=' + orderId;
    });
</script>

</body>
</html>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
