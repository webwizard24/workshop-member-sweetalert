<?php include('templates/header.php'); ?>

<h2 class="text-center mb-4">Register</h2>

<form action="process.php" method="POST" class="w-50 mx-auto" id="registerForm">
    <!-- First Name -->
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
    </div>

    <!-- Phone Number -->
    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
    </div>

    <!-- Date of Birth -->
    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
    </div>

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
        <div id="passwordMismatch" class="form-text text-danger" style="display: none;">
            Passwords do not match!
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
</form>


<script>
    // ตรวจสอบความสอดคล้องของรหัสผ่าน
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const mismatchText = document.getElementById('passwordMismatch');

        if (password !== confirmPassword) {
            event.preventDefault(); // หยุดการส่งฟอร์ม
            mismatchText.style.display = 'block'; // แสดงข้อความแจ้งเตือน
        } else {
            mismatchText.style.display = 'none'; // ซ่อนข้อความถ้ารหัสผ่านตรงกัน
        }
    });
</script>

<!-- Link to Login -->
<div class="text-center mt-3">
    <p>Already have an account?</p>
    <a href="login.php" class="btn btn-outline-secondary">Login</a>
</div>

<?php include('templates/footer.php'); ?>