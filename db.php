<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";
$port = 3390;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
