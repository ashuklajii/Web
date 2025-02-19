<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<nav class="navbar navbar-expand-sm fixed-top  bg-light">
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
        </li>
      </ul>
      <div class="d-flex">
      <a href="../seller/seller_dashboard.php "><i class="bi bi-coin margin-right-6 me-4 hover-icon"></i></a>
      <a href="user_orders.php"><i class="bi bi-bag-fill  margin-right-6 me-4 hover-icon"></i></a>
        <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>     

      </div>
    </div>
  </div>
</nav>
<body class="bg-light text-dark p-4">
    <div class="container">
        <h1 class="text-center mb-4">Book Store</h1>
        <form id="filter-form" method="GET" action="" class="row g-3 justify-content-center">
            <div class="col-md-3">
                <select id="class_level" name="class_level" class="form-select" onchange="this.form.submit()">
                    <option value="">Select Class</option>
                    <option value="9">Class 9th</option>
                    <option value="10">Class 10th</option>
                    <option value="11">Class 11th</option>
                    <option value="12">Class 12th</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="medium" name="medium" class="form-select" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="English">English</option>
                    <option value="Hindi">Hindi</option>
                    <option value="Gujarati">Gujarati</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
        
        <div id="book-list" class="row mt-4">
            <?php
            include 'db_connection.php';
            $class_level = isset($_GET['class_level']) ? $_GET['class_level'] : '';
            $medium = isset($_GET['medium']) ? $_GET['medium'] : '';
            $query = "SELECT b.*, bi.image_path FROM books AS b LEFT JOIN book_images AS bi ON b.book_id = bi.book_id WHERE 1=1";
            if ($class_level != '') { $query .= " AND b.class_level = '$class_level'"; }
            if ($medium != '') { $query .= " AND b.medium = '$medium'"; }
            $result = mysqli_query($conn, $query);
            if (!$result) { die("Query failed: " . mysqli_error($conn)); }
            if (mysqli_num_rows($result) > 0) {
                while ($book = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card shadow-sm'>";
                    if (!empty($book['image_path'])) {
                        echo "<img src='" . htmlspecialchars($book['image_path']) . "' class='card-img-top' alt='" . htmlspecialchars($book['name']) . "'>";
                    } else {
                        echo "<div class='card-body text-center'><p>No image available</p></div>";
                    }
                    echo "<div class='card-body text-center'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($book['name']) . "</h5>";
                    echo "<p class='card-text'>Description: " . htmlspecialchars($book['description']) . "</p>";
                    echo "<p class='card-text'>Class Level: " . htmlspecialchars($book['class_level']) . "</p>";
                    echo "<p class='card-text'>Medium: " . htmlspecialchars($book['medium']) . "</p>";
                    echo "<p class='card-text fw-bold'>Price: ₹" . htmlspecialchars($book['price']) . "</p>";
                    echo "<button class='btn btn-success' onclick='confirmPurchase(" . $book['book_id'] . ")'>Buy</button>";
                    echo "</div></div></div>";
                }
            } else {
                echo "<p class='text-center'>No books available for the selected filters.</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function confirmPurchase(bookId) {
            const confirmBuy = confirm("Do you want to buy this book?");
            if (confirmBuy) {
                window.location.href = `buy_book.php?book_id=${bookId}`;
            }
        }
    </script>
</body>
</html>
