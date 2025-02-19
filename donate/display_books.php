<?php
$conn = new mysqli("localhost", "root", "", "book_hives");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to Donate books!'); window.location.href='user_login.php';</script>";

    // exit();
}
// else{
//     header("location:donate_books");
//     exit();
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donated Books</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Donated Books</h2>
        <a href="donate_book.php" class="btn btn-primary mb-3">Donate Another Book</a>
        <a href="../user/index.php" class="btn btn-outline-dark btn-sm position-absolute" 
       style="top: 10px; right: 10px; border-radius: 50%; padding: 5px 10px; font-size: 18px;">
        &times;
    </a>        <div class="row">
            <?php
            $books = $conn->query("SELECT * FROM donate_books ORDER BY id DESC");
            while ($book = $books->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card shadow'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$book['name']}</h5>
                                <p class='card-text'><b>Class:</b> {$book['class']}, <b>Medium:</b> {$book['medium']}</p>
                                <p class='card-text'><b>Address:</b> {$book['address']}</p>
                                <p class='card-text'><b>Mobile:</b> {$book['mobile']}</p>
                                <div class='d-flex flex-wrap'>";
                                $images = $conn->query("SELECT * FROM donate_book_images WHERE book_id='{$book['id']}'");
                                while ($image = $images->fetch_assoc()) {
                    echo "<img src='{$image['image_path']}' class='img-fluid m-1' style='width: 80px; height: 80px;'>";
                }
                echo "      </div>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
