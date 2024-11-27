<?php
$host = ''; // ใส่ host ของคุณ
$database = ''; // ใส่ database ของคุณ
$username = ''; // ใส่ username ของคุณ
$password = ''; // ใส่ password ของคุณ

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $database :" . $e->getMessage());
}
