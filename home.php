<?php
session_start();
include('db.php');

// กำหนด Timeout เป็น 5 นาที (300 วินาที)
$timeout_duration = 300;

// ตรวจสอบเวลาล่าสุด
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // หากเกินเวลาที่กำหนด ให้ทำการ Logout
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// อัปเดตเวลาล่าสุด
$_SESSION['last_activity'] = time();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$username = $_SESSION['user'];
$stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// หากไม่มีข้อมูลผู้ใช้
if (!$user) {
    echo "User not found.";
    exit();
}
?>

<?php include('templates/header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Welcome, <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>!</h2>
                </div>
                <div class="card-body text-center">
                    <p>Manage your profile or logout using the options below:</p>
                    <a href="edit_user.php" class="btn btn-warning m-2">Edit Profile</a>
                    <a href="logout.php" class="btn btn-danger m-2">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('templates/footer.php'); ?>
