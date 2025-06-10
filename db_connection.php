<?php
$host = 'localhost';
$db = 'lemon_shop';
$user = 'root'; // หรือชื่อผู้ใช้ของคุณ
$pass = ''; // ถ้าเป็น XAMPP/MAMP/WAMP ปกติจะไม่มีรหัสผ่าน

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
