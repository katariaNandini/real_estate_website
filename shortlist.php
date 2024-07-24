<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];

$sql = "INSERT INTO shortlisted_properties (user_id, property_id) VALUES ('$user_id', '$property_id')";
mysqli_query($conn, $sql);

header('Location: index.php');
?>