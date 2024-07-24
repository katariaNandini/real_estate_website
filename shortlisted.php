<?php
include 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<div class="container mt-5">
<h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1">Shortlisted properties</h3>
    <div class="row">
        <?php
        include 'db.php';

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT p.* FROM properties p INNER JOIN shortlisted_properties sp ON p.id = sp.property_id WHERE sp.user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        while ($property = mysqli_fetch_assoc($result)) {
            $property_id = $property['id'];
            $heart_class = 'fas fa-heart text-danger';

            echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4'>";
            echo "<div class='card property-card border-light shadow-sm'>";
            echo "<img src='{$property['image']}' class='card-img-top' alt='{$property['title']}'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$property['title']}</h5>";
            echo "<p class='card-text'>Location: " . (isset($property['location']) ? $property['location'] : 'N/A') . "</p>";
            echo "<p class='card-text'>Price: {$property['price']}</p>";
            echo "<p class='card-text'>Size: " . (isset($property['size']) ? $property['size'] : 'N/A') . " sq ft</p>";
            echo "<div class='d-flex justify-content-between align-items-center'>";
            echo "<a href='property_details.php?id=$property_id' class='btn btn-primary'>View Property</a>";
            echo "<i class='$heart_class shortlist-toggle' data-property-id='$property_id'></i>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>
