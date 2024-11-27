<?php include('templates/header.php'); ?>

<h2 class="text-center mb-4">Login</h2>

<form action="process.php" method="POST" class="w-50 mx-auto">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
</form>

<!-- เพิ่มปุ่ม Register -->
<div class="text-center mt-3">
    <p>Don't have an account?</p>
    <a href="register.php" class="btn btn-outline-secondary">Register</a>
</div>

<?php include('templates/footer.php'); ?>