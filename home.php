<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include('templates/header.php'); ?>

<h2 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
<a href="logout.php" class="btn btn-danger">Logout</a>

<?php include('templates/footer.php'); ?>
