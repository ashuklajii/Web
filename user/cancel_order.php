<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); 


    $query = "SELECT * FROM purchases WHERE purchase_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        
        $delete_query = "DELETE FROM purchases WHERE purchase_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
        $delete_result = mysqli_stmt_execute($stmt);

        if ($delete_result) {
            header("Location: user_orders.php?status=success");
            exit;
        } else {
            echo "Failed to cancel the order: " . mysqli_error($conn);
        }
    } else {
        echo "Order not found .";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid order ID.";
}

mysqli_close($conn);
?>
