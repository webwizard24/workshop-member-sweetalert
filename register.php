<?php include('templates/header.php'); ?>

<h2 class="text-center mb-4">Register</h2>

<form action="process.php" method="POST" class="w-50 mx-auto">
    <!-- Username -->
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
    </div>
    
    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    
    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter a strong password" required>
    </div>
    
    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
</form>

<!-- Link to Login -->
<div class="text-center mt-3">
    <p>Already have an account?</p>
    <a href="login.php" class="btn btn-outline-secondary">Login</a>
</div>

<?php include('templates/footer.php'); ?>
