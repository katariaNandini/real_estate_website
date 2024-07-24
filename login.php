<?php include 'header.php'; ?>

<div class="login-form">
    <h3 class="text-center">Login</h3>
    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <form action="login_process.php" method="post">
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <div class="text-center mt-3">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>
<?php include 'footer.php'; ?>
