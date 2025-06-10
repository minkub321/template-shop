<?php 
session_start();

if (isset($_POST['username'])) {
    include("condb.php");

    // รับค่าจากฟอร์มและป้องกัน SQL Injection
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // รอการตรวจสอบด้วย password_verify

    // คำสั่ง SQL ตรวจสอบ username
    $sql_login = "
    SELECT user_id, username, email, password, phone_number, credit_balance, user_role, created_at
    FROM users
    WHERE username = '$username';
    ";

    $result = mysqli_query($con, $sql_login);

    if (!$result) {
        die("Query Failed: " . mysqli_error($con)); // ตรวจสอบ SQL Error
    }

    // ตรวจสอบว่าพบข้อมูลผู้ใช้งานหรือไม่
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $row["password"])) {
            // ตั้งค่าข้อมูล Session
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["phone_number"] = $row["phone_number"] ?? null;  
            $_SESSION["credit_balance"] = $row["credit_balance"] ?? 0;
            $_SESSION["user_role"] = $row["user_role"];

            // ตรวจสอบบทบาทผู้ใช้งาน
            if ($row["user_role"] == "admin") {
                header("Location: admin/");
                exit();
            } else {
                echo "<script>";
                echo "alert('คุณไม่มีสิทธิ์เข้าถึงระบบนี้');";
                echo "window.history.back();";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('รหัสผ่านไม่ถูกต้อง');";
            echo "window.history.back();";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert('ไม่พบบัญชีผู้ใช้งาน');";
        echo "window.history.back();";
        echo "</script>";
    }
}
?>
