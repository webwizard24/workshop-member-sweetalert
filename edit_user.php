<?php
session_start();
include('db.php');

// โค้ดตรวจสอบ Timeout 
$timeout_duration = 300;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=true");
    exit();
}

$_SESSION['last_activity'] = time();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$username = $_SESSION['user'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// หากไม่มีข้อมูลผู้ใช้
if (!$user) {
    echo "User not found.";
    exit();
}

// อัปเดตข้อมูลผู้ใช้
if (isset($_POST['update'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // เข้ารหัสรหัสผ่านใหม่ (ถ้ามีการเปลี่ยนแปลง)
    $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

    try {
        // อัปเดตข้อมูลในฐานข้อมูล
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, date_of_birth = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$first_name, $last_name, $phone_number, $date_of_birth, $email, $hashedPassword, $user['id']]);

        // อัปเดต Session
        $_SESSION['user'] = $username;

        // แจ้งเตือนสำเร็จ
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Update Successful',
                    text: 'Your profile has been updated.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'home.php';
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
                    title: 'Update Failed',
                    text: 'Something went wrong. Please try again later.',
                    confirmButtonText: 'Try Again'
                });
            });
        </script>";
    }
}
?>

<?php include('templates/header.php'); ?>

<h2 class="text-center mb-4">Edit Profile</h2>

<form action="edit_user.php" method="POST" class="w-50 mx-auto">
    <!-- First Name -->
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
    </div>

    <!-- Phone Number -->
    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
    </div>

    <!-- Date of Birth -->
    <div class="mb-3">
        <label for="date_of_birth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">New Password (optional)</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
    </div>

    <!-- Submit Button -->
    <div class="mb-3">
        <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
    </div>

    <div class="mb-3">
        <a href="logout.php" class="btn btn-warning w-100">Logout</a>
    </div>
</form>

<?php include('templates/footer.php'); ?>