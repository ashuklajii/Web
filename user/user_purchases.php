<?php
session_start();
include 'db_connection.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT b.*, bi.image_path, p.purchase_date 
          FROM purchases AS p
          INNER JOIN books AS b ON p.book_id = b.book_id
          LEFT JOIN book_images AS bi ON b.book_id = bi.book_id
          WHERE p.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchases</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">My Purchases</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while ($book = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <?php if (!empty($book['image_path'])): ?>
                                <img src="<?= htmlspecialchars($book['image_path']) ?>" 
                                     alt="<?= htmlspecialchars($book['name']) ?>" 
                                     class="card-img-top" style="max-height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div class="card-img-top text-center bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px; color: #999;">
                                    <span>No Image Available</span>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?= htmlspecialchars($book['name']) ?></h5>
                                <p class="card-text">
                                    <strong>Price: </strong> ₹<?= htmlspecialchars($book['price']) ?>
                                </p>
                                <p class="card-text">
                                    <strong>Description: </strong> <?= htmlspecialchars($book['description']) ?>
                                </p>
                                <p class="card-text">
                                    <strong>Purchase Date: </strong> <?= htmlspecialchars($book['purchase_date']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <h5 class="text-muted">You have not purchased any books yet.</h5>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
