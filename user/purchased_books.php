<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT b.name, b.price, b.description 
          FROM purchases AS p 
          JOIN books AS b ON p.book_id = b.book_id 
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Purchased Books</h2>
<div class="row">
    <?php while ($book = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?= htmlspecialchars($book['name']) ?></h5>
                    <p class="card-text"><strong>Price: </strong> ₹<?= htmlspecialchars($book['price']) ?></p>
                    <p class="card-text"><?= htmlspecialchars($book['description']) ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
