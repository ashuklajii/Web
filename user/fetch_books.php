 <?php
// include 'db_connection.php';

// $class_level = $_GET['class_level'] ?? '';
// $medium = $_GET['medium'] ?? '';

// $query = "SELECT b.*, bi.image_path 
//           FROM books AS b 
//           LEFT JOIN book_images AS bi ON b.book_id = bi.book_id 
//           WHERE b.class_level = ? AND b.medium = ?";

// $stmt = $conn->prepare($query);
// $stmt->bind_param('ss', $class_level, $medium);
// $stmt->execute();
// $result = $stmt->get_result();
?> 

<!-- <div class="container my-4">
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <?php if (!empty($book['image_path'])): ?>
                            <img src="<?= htmlspecialchars($book['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($book['name']) ?>" 
                                 class="card-img-top" style="max-height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top text-center bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px; color: #999;">
                                <span>No Image Available</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($book['name']) ?></h5>
                            <p class="card-text"><strong>Price: </strong> ₹<?= htmlspecialchars($book['price']) ?></p>
                            <p class="card-text"><strong>Description: </strong> <?= htmlspecialchars($book['description']) ?></p>
                            <p class="card-text"><strong>Class: </strong> <?= htmlspecialchars($book['class_level']) ?></p>
                            <p class="card-text"><strong>Medium: </strong> <?= htmlspecialchars($book['medium']) ?></p>
                            <button type="button" class="btn btn-outline-primary btn-sm w-100 mt-2 buy-button" 
                                    data-bs-toggle="modal" data-bs-target="#buyModal" 
                                    data-book-id="<?= $book['book_id'] ?>" 
                                    data-book-name="<?= htmlspecialchars($book['name']) ?>" 
                                    data-book-price="<?= htmlspecialchars($book['price']) ?>">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center p-4">
            <h5 class="text-muted">No books found for Class <?= htmlspecialchars($class_level) ?> in <?= htmlspecialchars($medium) ?> medium.</h5>
        </div>
    <?php endif; ?>
</div> -->

<!-- Modal -->
<!-- <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Confirm Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to buy <span id="modalBookName" class="fw-bold"></span> for ₹<span id="modalBookPrice"></span>?</p>
            </div>
            <div class="modal-footer">
                <form id="buyForm" method="POST" action="buy_book.php">
                    <input type="hidden" name="book_id" id="modalBookId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes, Buy</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div id="book-list">
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
                echo "<div class='book-card'>";
                if (!empty($book['image_path'])) {
                    echo "<img src='" . htmlspecialchars($book['image_path']) . "' alt='" . htmlspecialchars($book['name']) . "' />";
                } else {
                    echo "<p>No image available</p>";
                }
                echo "<div class='book-details'>";
                echo "<h3>" . htmlspecialchars($book['name']) . "</h3>";
                echo "<p>Description: " . htmlspecialchars($book['description']) . "</p>";
                echo "<p>Class Level: " . htmlspecialchars($book['class_level']) . "</p>";
                echo "<p>Medium: " . htmlspecialchars($book['medium']) . "</p>";
                echo "<p>Price: ₹" . htmlspecialchars($book['price']) . "</p>";
                echo "<button onclick='confirmPurchase(" . $book['book_id'] . ")'>Buy</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No books available for the selected filters.</p>";
        }
        ?>
    </div>

    <script>
        function confirmPurchase(bookId) {
            const confirmBuy = confirm("Do you want to buy this book?");
            if (confirmBuy) {
                window.location.href = `buy_book.php?book_id=${bookId}`;
            }
        }
    </script>

<!-- Footer -->
<footer class="bg-dark text-center text-lg-start mt-4 text-light">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase">About Us</h5>
                <p>
                    We are a company dedicated to providing the best services to our customers. Our mission is to deliver quality and excellence in everything we do.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Home</a></li>
                    <li><a href="#" class="text-light">Features</a></li>
                    <li><a href="#" class="text-light">Contact</a></li>
                    <li><a href="#" class="text-light">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Follow Us</h5>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook hover-icon"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-twitter hover-icon"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-instagram hover-icon"></i></a>
                <a href="#" class="text-light"><i class="bi bi-linkedin hover-icon"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-light text-dark">
        © 2024 <b>Book</b>Hives. All rights reserved.
    </div>
</footer>

<script>
document.querySelectorAll('.buy-button').forEach(button => {
    button.addEventListener('click', function () {
        const bookId = this.getAttribute('data-book-id');
        const bookName = this.getAttribute('data-book-name');
        const bookPrice = this.getAttribute('data-book-price');

        document.getElementById('modalBookName').textContent = bookName;
        document.getElementById('modalBookPrice').textContent = bookPrice;
        document.getElementById('modalBookId').value = bookId;
    });
});
</script>
