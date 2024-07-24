<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $contact_name = $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    // Image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO properties (title, description, location, price, size, contact_name, contact_email, contact_phone, image) 
            VALUES ('$title', '$description', '$location', '$price', '$size', '$contact_name', '$contact_email', '$contact_phone', '$target_file')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the properties page
        header("Location: properties.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
