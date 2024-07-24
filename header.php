<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['username']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHomes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark -top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">DreamHomes</a>
        <?php if (!in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'register.php'])): ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="properties.php">Properties</a>
                </li>
                <?php if ($is_logged_in): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_property.php">Add Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shortlisted.php">Shortlisted Property</a>
                    </li>
                    <li class="ms-5 ps-5 nav-item">
                        <a class="nav-link text-capitalize" href="#"> <i class="fa-solid fa-user text-white me-2"></i><?php echo $username; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class=" btn btn-light text-dark fw-bold ms-2" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class=" btn btn-light text-dark fw-bold ms-2" href="login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <?php if (basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
                        <li class="nav-item">
                            <a class=" btn btn-light text-dark fw-bold ms-2" href="register.php">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container-fluid px-0">
