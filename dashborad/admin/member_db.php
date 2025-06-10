<?php 
echo '<meta charset="utf-8">';
include('condb.php'); // เรียกใช้การเชื่อมต่อฐานข้อมูล

// ตรวจสอบการเชื่อมต่อ
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ตั้งค่า array สำหรับเก็บข้อผิดพลาด
$errors = [];

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กรองข้อมูลที่ผู้ใช้ป้อน
    $user_name = mysqli_real_escape_string($con, $_POST["user_name"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $num_phone = mysqli_real_escape_string($con, $_POST["num_phone"]);
    $date_birth = mysqli_real_escape_string($con, $_POST["date_birth"]);
    $A_ddress = mysqli_real_escape_string($con, $_POST["A_ddress"]);
    $G_ender = mysqli_real_escape_string($con, $_POST["G_ender"]);
    $user_level = mysqli_real_escape_string($con, $_POST["user_level"]);

    // ตรวจสอบว่าข้อมูลครบถ้วน
    if (empty($user_name) || empty($password) || empty($email) || 
        empty($num_phone) || empty($date_birth) || empty($A_ddress) || 
        empty($G_ender) || empty($user_level)) {
        $errors[] = "กรุณากรอกข้อมูลให้ครบทุกช่อง.";
    }

    // ตรวจสอบรูปแบบอีเมล
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "รูปแบบอีเมล์ไม่ถูกต้อง.";
    }

    // ตรวจสอบว่าอีเมลมีอยู่แล้วหรือไม่
    $check_email_sql = "SELECT * FROM user_table WHERE email = ?";
    $stmt = $con->prepare($check_email_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check_email_result = $stmt->get_result();
    if ($check_email_result->num_rows > 0) {
        $errors[] = "อีเมล์นี้มีอยู่ในระบบแล้ว.";
    }
    $stmt->close();

    // หากไม่มีข้อผิดพลาด
    if (empty($errors)) {
        // เข้ารหัสรหัสผ่านก่อนเก็บในฐานข้อมูล
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // การใช้ prepared statement สำหรับการเพิ่มข้อมูล
        $stmt = $con->prepare("INSERT INTO user_table (user_name, email, password, num_phone, date_birth, A_ddress, G_ender, user_level)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $user_name, $email, $hashed_password, $num_phone, $date_birth, $A_ddress, $G_ender, $user_level);

        if ($stmt->execute()) {
            // การเพิ่มข้อมูลสำเร็จ
            echo '<script>window.location="member.php?do=success";</script>';
        } else {
            // ข้อผิดพลาดจากการ query
            echo '<script>window.location="member.php?do=f";</script>';
        }
        $stmt->close(); 
    } else {
        // แสดงข้อผิดพลาด
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
        echo '<script>window.location="member.php";</script>'; 
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($con);
?>
