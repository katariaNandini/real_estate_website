<?php
include 'header.php';
include 'db.php';

// Assuming user ID is stored in session after login
$user_id = $_SESSION['user_id'];

// Fetch filter criteria from the form submission
$property_type = isset($_GET['property_type']) ? $_GET['property_type'] : [];
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 1000000;
$location = isset($_GET['location']) ? $_GET['location'] : '';
$min_size = isset($_GET['min_size']) ? $_GET['min_size'] : 0;
$max_size = isset($_GET['max_size']) ? $_GET['max_size'] : 10000;
$contact_name = isset($_GET['contact_name']) ? $_GET['contact_name'] : '';
$contact_email = isset($_GET['contact_email']) ? $_GET['contact_email'] : '';
$contact_phone = isset($_GET['contact_phone']) ? $_GET['contact_phone'] : '';

// Build the query with filters
$sql = "SELECT p.*, sp.id AS shortlist_id FROM properties p
        LEFT JOIN shortlisted_properties sp ON p.id = sp.property_id AND sp.user_id = '$user_id'
        WHERE 1=1";

if (!empty($property_type)) {
    $types = implode("','", $property_type);
    $sql .= " AND property_type IN ('$types')";
}

if ($min_price) {
    $sql .= " AND price >= $min_price";
}

if ($max_price) {
    $sql .= " AND price <= $max_price";
}

if ($location) {
    $sql .= " AND location LIKE '%$location%'";
}

if ($min_size) {
    $sql .= " AND size >= $min_size";
}

if ($max_size) {
    $sql .= " AND size <= $max_size";
}

if ($contact_name) {
    $sql .= " AND contact_name LIKE '%$contact_name%'";
}

if ($contact_email) {
    $sql .= " AND contact_email LIKE '%$contact_email%'";
}

if ($contact_phone) {
    $sql .= " AND contact_phone LIKE '%$contact_phone%'";
}

$result = mysqli_query($conn, $sql);
?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar for Filters -->
        <div class="col-md-3">
            <h4>Filters</h4>
            <form id="filter-form">
                <div class="form-group mb-3">
                    <label for="property_type" class="form-label fw-bold text-uppercase">Property Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rent" name="property_type[]" value="rent" <?php echo in_array('rent', $property_type) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="rent">Rent</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sale" name="property_type[]" value="sale" <?php echo in_array('sale', $property_type) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="sale">Sale</label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="min_price" class="form-label fw-bold text-uppercase">Min Price</label>
                    <div class="d-flex align-items-center">
                        <input class="form-range me-2" type="range" id="min_price" name="min_price" min="0" max="1000000" step="10000" value="<?php echo htmlspecialchars($min_price); ?>">
                        <input class="form-control" type="number" id="min_price_value" name="min_price_value" min="0" max="1000000" step="10000" value="<?php echo htmlspecialchars($min_price); ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="max_price" class="form-label fw-bold text-uppercase">Max Price</label>
                    <div class="d-flex align-items-center">
                        <input class="form-range me-2" type="range" id="max_price" name="max_price" min="0" max="1000000" step="10000" value="<?php echo htmlspecialchars($max_price); ?>">
                        <input class="form-control" type="number" id="max_price_value" name="max_price_value" min="0" max="1000000" step="10000" value="<?php echo htmlspecialchars($max_price); ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="min_size" class="form-label fw-bold text-uppercase">Min Size (sq ft)</label>
                    <div class="d-flex align-items-center">
                        <input class="form-range me-2" type="range" id="min_size" name="min_size" min="0" max="10000" step="100" value="<?php echo htmlspecialchars($min_size); ?>">
                        <input class="form-control" type="number" id="min_size_value" name="min_size_value" min="0" max="10000" step="100" value="<?php echo htmlspecialchars($min_size); ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="max_size" class="form-label fw-bold text-uppercase">Max Size (sq ft)</label>
                    <div class="d-flex align-items-center">
                        <input class="form-range me-2" type="range" id="max_size" name="max_size" min="0" max="10000" step="100" value="<?php echo htmlspecialchars($max_size); ?>">
                        <input class="form-control" type="number" id="max_size_value" name="max_size_value" min="0" max="10000" step="100" value="<?php echo htmlspecialchars($max_size); ?>">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="location" class="form-label fw-bold text-uppercase">Location</label>
                    <select class="form-select" id="location" name="location">
                        <option value="" selected>Choose...</option>
                        <option value="New York" <?php echo $location == 'New York' ? 'selected' : ''; ?>>New York</option>
                        <option value="Los Angeles" <?php echo $location == 'Los Angeles' ? 'selected' : ''; ?>>Los Angeles</option>
                        <option value="Chicago" <?php echo $location == 'Chicago' ? 'selected' : ''; ?>>Chicago</option>
                        <option value="Houston" <?php echo $location == 'Houston' ? 'selected' : ''; ?>>Houston</option>
                        <option value="Phoenix" <?php echo $location == 'Phoenix' ? 'selected' : ''; ?>>Phoenix</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- List of Properties -->
        <div class="col-md-9">
            <h3 class="text-center mb-4">All Properties</h3>
            <div class="row" id="property-list">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($property = mysqli_fetch_assoc($result)) {
                        $property_id = $property['id'];
                        $heart_class = $property['shortlist_id'] ? 'fas fa-heart text-danger' : 'far fa-heart';

                        echo "<div class='col-lg-4 col-md-6 mb-4'>";
                        echo "<div class='card property-card border-light shadow-sm'>";
                        echo "<img src='{$property['image']}' class='card-img-top' alt='{$property['title']}'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>{$property['title']}</h5>";
                        echo "<p class='card-text'>Price: \${$property['price']}</p>";
                        echo "<p class='card-text'>Type: {$property['property_type']}</p>";
                        echo "<div class='d-flex justify-content-between align-items-center'>";
                        echo "<a href='property_details.php?id=$property_id' class='btn btn-primary'>View Property</a>";
                        echo "<i class='$heart_class shortlist-toggle' data-property-id='$property_id'></i>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12'>";
                    echo "<div class='alert alert-warning text-center' role='alert'>No properties available</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
