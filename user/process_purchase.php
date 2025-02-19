<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $input = json_decode(file_get_contents('php://input'), true);
    
    $book_id = $input['book_id'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;

    if ($book_id && $user_id) {
        $stmt = $conn->prepare("INSERT INTO purchases (user_id, book_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $book_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }
}
?>
