<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $user_role = 'user'; // Default role
    $created_at = date('Y-m-d H:i:s'); // Current timestamp

    // ตรวจสอบชื่อผู้ใช้, อีเมล, และเบอร์โทรศัพท์ซ้ำ
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ? OR phone_number = ?");
    $stmt->execute([$username, $email, $phone_number]);

    if ($stmt->rowCount() > 0) {
        $error = "ชื่อผู้ใช้, อีเมล หรือเบอร์โทรนี้มีอยู่ในระบบแล้ว";
    } else {
        // บันทึกข้อมูลลงในฐานข้อมูล
        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone_number, password, credit_balance, user_role, created_at) 
                               VALUES (?, ?, ?, ?, 0, ?, ?)");
        $stmt->execute([$username, $email, $phone_number, $password, $user_role, $created_at]);

        header('Location: login.php'); // กลับไปหน้า Login หลังสมัครสมาชิกสำเร็จ
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก</title>
</head>
<body>
    <form method="POST">
        <h1>สมัครสมาชิก</h1>
        <label>ชื่อผู้ใช้:</label>
        <input type="text" name="username" required>
        
        <label>อีเมล:</label>
        <input type="email" name="email" required>

        <label>เบอร์โทรศัพท์:</label>
        <input type="text" name="phone_number" required>

        <label>รหัสผ่าน:</label>
        <input type="password" name="password" required>

        <button type="submit">สมัครสมาชิก</button>

        <?php if (!empty($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </form>
    <p>มีบัญชีอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
</body>
</html>
