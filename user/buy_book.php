<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id'];

$query = "INSERT INTO purchases (user_id, book_id) VALUES ('$user_id', '$book_id')";
mysqli_query($conn, $query);
header("Location: user_orders.php");
?>
