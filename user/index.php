<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="index.css">
</head>
<body>


<!-- navbaar -->

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
       <a href="../donate/display_books.php "><img src="../images/book (1).png" class="margin-right-6  me-4 " height="23px" width="25px" alt=""></a>
      <a href="../seller/seller_dashboard.php "><i class="bi bi-coin margin-right-6 me-4 hover-icon"></i></a>
      <a href="user_orders.php"><i class="bi bi-bag-fill  margin-right-6 me-4 hover-icon"></i></a>
            <!-- <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>      -->
        <a href="user_signup.php"><i class="bi bi-person-circle margin-right-6 me-4 hover-icon  "> </i> </a>     

      </div>
    </div>
  </div>
</nav>
<!-- slider -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-item active">                                         
      <img src="../images/photo.png" class="d-block w-100 carousel-image" alt="First slide" >
    </div>
    <div class="carousel-item">
      <img src="../images/Events.png" class="d-block w-100 carousel-image" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img src="../images/Offers.png" class="d-block w-100 carousel-image" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img src="../images/Home.png" class="d-block w-100 carousel-image " alt="Third slide">
    </div>
    <!-- <div class="carousel-item">
      <img src="images/i1.png" class="d-block w-100 carousel-image" alt="Third slide">
    </div> -->
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Book Section -->
<section class="container my-5">
  <h2 class="text-center mb-4">Our Books</h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="../images/zara.png" class="card-img-top" alt="Product 1">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text"></p>
          <p class="card-text"><strong></strong></p>
          <button class="btn btn-light btn-lg">Shop Now</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="../images/noah.png" class="card-img-top" alt="Product 2">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text"></p>
          <p class="card-text"><strong></strong></p>
          <button class="btn btn-light btn-lg">Shop Now</button>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="../images/jamie.png" class="card-img-top" alt="Product 3">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text"></p>
          <p class="card-text"><strong></strong></p>
          <button class="btn btn-light btn-lg">Shop Now</button>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- footer -->
<footer class="bg-dark text-center text-lg-start mt-4">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4">
        <h5 class="text-uppercase text-light">About Us</h5>
        <p class="text-light">
          We are a company dedicated to providing the best services to our customers. Our mission is to deliver quality and excellence in everything we do.
        </p>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 text-light">
        <h5 class="text-uppercase">Links</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#" class="text-light">Home</a>
          </li>
          <li>
            <a href="#" class="text-light">Features</a>
          </li>
          <li>
            <a href="#" class="text-light">Contact</a>
          </li>
          <li>
            <a href="#" class="text-light">Privacy Policy</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 text-light">
        <h5 class="text-uppercase ">Follow Us</h5>
        <a href="#" class="text-light me-3 "><i class="bi bi-facebook  hover-icon"></i></a>
        <a href="#" class="text-light me-3"><i class="bi bi-twitter hover-icon"></i></a>
        <a href="#" class="text-light me-3"><i class="bi bi-instagram hover-icon"></i></a>
        <a href="#" class="text-light"><i class="bi bi-linkedin hover-icon"></i></a>
      </div>
    </div>
  </div>

  <div class="text-center p-3 bg-light">
    © 2024 <b>Book</b>Hives. All rights reserved.
  </div>
</footer>

</body>
</html>
