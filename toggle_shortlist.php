<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];

// Check if the property is already shortlisted by the user
$sql = "SELECT * FROM shortlisted_properties WHERE user_id = '$user_id' AND property_id = '$property_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Remove from shortlist
    $sql = "DELETE FROM shortlisted_properties WHERE user_id = '$user_id' AND property_id = '$property_id'";
    mysqli_query($conn, $sql);
    echo 'removed';
} else {
    // Add to shortlist
    $sql = "INSERT INTO shortlisted_properties (user_id, property_id) VALUES ('$user_id', '$property_id')";
    mysqli_query($conn, $sql);
    echo 'added';
}
?>
