<?php
session_start();
session_unset(); // ลบข้อมูลเซสชันทั้งหมด
session_destroy(); // ทำลายเซสชัน
header("Location: login.php"); // Redirect ไปยังหน้าเข้าสู่ระบบ
exit();
?>
