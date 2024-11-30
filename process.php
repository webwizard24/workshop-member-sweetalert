<?php
session_start();
include('db.php');

// สมัครสมาชิก
if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // ตรวจสอบรหัสผ่าน
    if ($password !== $confirmPassword) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Passwords do not match!',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location = 'register.php';
                });
            });
        </script>";
        exit();
    }

    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, phone_number, date_of_birth, username, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone_number, $date_of_birth, $username, $email, $hashedPassword]);

        // แจ้งเตือนสำเร็จ
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'You can now login with your account.',
                    confirmButtonText: 'Login Now'
                }).then(() => {
                    window.location = 'login.php';
                });
            });
        </script>";
    } catch (Exception $e) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: 'An error occurred. Please try again later.',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location = 'register.php';
                });
            });
        </script>";
    }
}


// เข้าสู่ระบบ
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: home.php");
        exit();
    } else {
        // แสดง SweetAlert สำหรับการเข้าสู่ระบบล้มเหลว
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Invalid username or password!',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location = 'login.php';
                });
            });
        </script>";
    }
}
