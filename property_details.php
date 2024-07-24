<?php
include 'header.php';
include 'db.php';

$property_id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM properties WHERE id = $property_id";
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

if (!$property) {
    echo "<div class='container my-5'><h3 class='text-center'>Property not found</h3></div>";
    include 'footer.php';
    exit;
}
?>

<div class="container d-block my-5">
    <h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1"><?php echo htmlspecialchars($property['title']); ?></h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 border-light shadow-sm">
                <img src="<?php echo $property['image']; ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($property['title']); ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-light shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Property Details</h4>
                    <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($property['description']); ?></p>
                    <p class="card-text"><strong>Location:</strong> <?php echo htmlspecialchars($property['location']); ?></p>
                    <p class="card-text"><strong>Price:</strong> $<?php echo number_format(htmlspecialchars($property['price']), 2); ?></p>
                    <p class="card-text"><strong>Size:</strong> <?php echo htmlspecialchars($property['size']); ?> sq ft</p>
                </div>
            </div>
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Contact Information</h4>
                    <p class="card-text"><strong>Name:</strong> <?php echo htmlspecialchars($property['contact_name']); ?></p>
                    <p class="card-text"><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($property['contact_email']); ?>"><?php echo htmlspecialchars($property['contact_email']); ?></a></p>
                    <p class="card-text"><strong>Phone:</strong> <a href="tel:<?php echo htmlspecialchars($property['contact_phone']); ?>"><?php echo htmlspecialchars($property['contact_phone']); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
