<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $confirm_password = $_POST['confirm_password'];

    if ($_POST['new_password'] === $confirm_password) {
        $sql = "SELECT * FROM users WHERE reset_token = '$token'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE users SET password='$new_password', reset_token=NULL WHERE reset_token='$token'";
            mysqli_query($conn, $sql);

            echo "Password has been reset successfully.";
        } else {
            echo "Invalid token.";
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>
