<?php include 'header.php'; ?>
<div class="register-form">
    <h3 class="text-center">Create an Account</h3>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>
    <form action="register_process.php" method="post">
        <div class="form-group mb-3">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
        </div>
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
    <?php if (isset($_SESSION['success_message'])): ?>
        <a href="login.php" class="btn btn-success btn-block mt-3">Login</a>
    <?php else: ?>
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
