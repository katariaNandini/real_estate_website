<?php
include 'db.php';
session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve search parameters
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
    $max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';
    $size = isset($_POST['size']) ? $_POST['size'] : '';

    // Build the SQL query
    $sql = "SELECT * FROM properties WHERE 1=1";
    if ($location) {
        $sql .= " AND location LIKE '%$location%'";
    }
    if ($min_price) {
        $sql .= " AND price >= $min_price";
    }
    if ($max_price) {
        $sql .= " AND price <= $max_price";
    }
    if ($size) {
        $sql .= " AND size >= $size";
    }
} else {
    $sql = "SELECT * FROM properties ORDER BY id DESC LIMIT 3";
}

$result = mysqli_query($conn, $sql);
?>

<?php include 'header.php'; ?>
<div class="container-fluid px-0">
    <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="uploads/s1.jpg" class="d-block w-100" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="uploads/s2.jpg" class="d-block w-100" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="uploads/s3.jpg" class="d-block w-100" alt="Third slide">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-4">
    <h3 class="mb-4 text-center fw-bold text-uppercase h1">search property</h3>
        <div class="search-bar mb-4">
            <form class="row g-3 mb-5" method="POST" action="">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="location" name="location" placeholder="City">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Min Price">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Max Price">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="size" name="size" placeholder="Size (sq ft)">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </form>
        </div>

        <h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1">Property Types</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-4">
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-building fa-3x mb-2"></i>
                        <p class="card-text">Apartments</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-home fa-3x mb-2"></i>
                        <p class="card-text">Houses</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-building fa-3x mb-2"></i>
                        <p class="card-text">Commercial</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-hotel fa-3x mb-2"></i>
                        <p class="card-text">Luxury</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-tree fa-3x mb-2"></i>
                        <p class="card-text">Cottages</p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-chess-rook fa-3x mb-2"></i>
                        <p class="card-text">Mansions</p>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1">special property</h3>
        <div class="highlighted-property mb-4">
            <div class="card border-light shadow-sm">
                <div class="row g-0 align-items-center">
                    <div class="col-md-8">
                        <img src="uploads/luxury_condo.jpg" class="img-fluid rounded-start" alt="Luxury Condos">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h5 class="card-title">Luxury Condos</h5>
                            <p class="card-text">7 nights from <strong>$150/night</strong></p>
                            <a href="#" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1">Listed properties</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php
            while ($property = mysqli_fetch_assoc($result)) {
                // Check if the property is already shortlisted by the user
                $property_id = $property['id'];
                $shortlist_sql = "SELECT * FROM shortlisted_properties WHERE user_id = '$user_id' AND property_id = '$property_id'";
                $shortlist_result = mysqli_query($conn, $shortlist_sql);
                $is_shortlisted = mysqli_num_rows($shortlist_result) > 0;
                
                $heart_class = $is_shortlisted ? 'fas fa-heart text-danger' : 'far fa-heart';

                echo "<div class='col mb-4'>";
                echo "<div class='card border-light shadow-sm'>";
                echo "<img src='{$property['image']}' class='card-img-top' alt='{$property['title']}'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$property['title']}</h5>";
                echo "<p class='card-text'>{$property['description']}</p>";
                echo "<p class='card-text'>Location: " . (isset($property['location']) ? $property['location'] : 'N/A') . "</p>";
                echo "<p class='card-text'>Price: \${$property['price']}</p>";
                echo "<p class='card-text'>Size: " . (isset($property['size']) ? $property['size'] : 'N/A') . " sq ft</p>";
                echo "<p class='card-text'>Contact: " . (isset($property['contact_name']) ? $property['contact_name'] : 'N/A') . " (" . (isset($property['contact_email']) ? $property['contact_email'] : 'N/A') . ", " . (isset($property['contact_phone']) ? $property['contact_phone'] : 'N/A') . ")</p>";
                echo "<div class='d-flex justify-content-between align-items-center'>";
                echo "<a href='#' class='btn btn-dark'>Contact Seller</a>";
                echo "<i class='$heart_class shortlist-toggle' data-property-id='$property_id'></i>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
