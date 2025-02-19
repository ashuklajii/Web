<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your purchases.";
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT p.purchase_time, b.name, b.price 
          FROM purchases AS p 
          JOIN books AS b ON p.book_id = b.book_id 
          WHERE p.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase History</title>
</head>
<body>
    <h2>Your Purchases</h2>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Book Name</th>
                <th>Price</th>
                <th>Purchase Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>₹<?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['purchase_time']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No purchases found.</p>
    <?php endif; ?>
</body>
</html>
