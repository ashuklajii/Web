<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM books";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>
    <h2>Books</h2>
    <?php while ($book = $result->fetch_assoc()): ?>
        <div>
            <h3><?= htmlspecialchars($book['name']) ?></h3>
            <p>Price: ₹<?= htmlspecialchars($book['price']) ?></p>
            <p>Description: <?= htmlspecialchars($book['description']) ?></p>
            <form method="POST" action="buy_book.php">
                <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                <button type="submit">Buy</button>
            </form>
        </div>
    <?php endwhile; ?>
</body>
</html>
