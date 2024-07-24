<?php
include 'header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<div class="container d-block my-5">
<h3 class="mt-5 mb-4 text-center fw-bold text-uppercase h1">add property</h3>
    <form action="add_property_process.php" method="post" enctype="multipart/form-data">
        <h4 class="mb-3">Property Details</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label fw-bold text-uppercase">Property Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Property Title" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="location" class="form-label fw-bold text-uppercase">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold text-uppercase">Property Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Property Description" required></textarea>
        </div>
        <h4 class="mb-3">Images</h4>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold text-uppercase">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <h4 class="mb-3">Pricing</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label fw-bold text-uppercase">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="size" class="form-label fw-bold text-uppercase">Size (sq ft)</label>
                <input type="number" class="form-control" id="size" name="size" placeholder="Size" required>
            </div>
        </div>
        <h4 class="mb-3">Contact Information</h4>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="contact_name" class="form-label fw-bold text-uppercase">Contact Name</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="contact_email" class="form-label fw-bold text-uppercase">Contact Email</label>
                <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="contact_phone" class="form-label fw-bold text-uppercase">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact Phone" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit Property</button>
    </form>
</div>

<?php include 'footer.php'; ?>
