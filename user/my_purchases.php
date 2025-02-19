<?php
session_start();
include 'db_connection.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT b.*, bi.image_path, p.purchase_date 
          FROM purchases AS p
          JOIN books AS b ON p.book_id = b.book_id
          LEFT JOIN book_images AS bi ON b.book_id = bi.book_id
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<head>
    <title>My Purchases</title>
</head>
<body>
<nav class="navbar navbar-expand-sm fixed-top bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>Book</b>Hives</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>
        <li class="nav-item">
           <!-- <a class="nav-link" href="seller/seller_dashboard.php">sell your book</a> -->
        </li>
      </ul>
      <div class="d-flex">
      <a href="../seller/seller_dashboard.php "><i class="bi bi-coin margin-right-6 me-4 hover-icon"></i></a>
      <a href="user_orders.php"><i class="bi bi-bag-fill  margin-right-6 me-4 hover-icon"></i></a>
            <!-- <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>      -->
        <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>     

      </div>
    </div>
  </div>
</nav>
    <div class="container">
        <h2>My Purchases</h2>
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
                                    <strong>Purchased On: </strong> <?= htmlspecialchars($book['purchase_date']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <h5 class="text-muted">You haven't purchased any books yet.</h5>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
