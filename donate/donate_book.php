<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to donate a book!'); window.location.href='user_login.php';</script>";
    exit();
}


$conn = new mysqli("localhost", "root", "", "book_hives");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $class = $_POST['class'];
    $medium = $_POST['medium'];

    $sql = "INSERT INTO donate_books (name, address, mobile, class, medium) VALUES ('$name', '$address', '$mobile', '$class', '$medium')";
    if ($conn->query($sql) === TRUE) {
        $book_id = $conn->insert_id;
        
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = "uploads/";
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($_FILES['images']['name'][$key]);
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($tmp_name, $filePath)) {
                    $conn->query("INSERT INTO donate_book_images (book_id, image_path) VALUES ('$book_id', '$filePath')");
                }
            }
        }
        echo "<script>alert('Book donation successful!'); window.location.href='display_books.php';</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate a Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Donate a Book</h2>
        <div class="card p-4 shadow">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Class</label>
                    <input type="text" name="class" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Medium</label>
                    <input type="text" name="medium" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Book Images</label>
                    <input type="file" name="images[]" class="form-control" multiple required>
                </div>
                <button type="submit" class="btn btn-primary">Donate Book</button>
                <a href="display_books.php" class="btn btn-secondary">View Donated Books</a>
            </form>
        </div>
    </div>
</body>
</html>
