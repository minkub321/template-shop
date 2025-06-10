<?php
include("condb.php"); // เชื่อมต่อฐานข้อมูล

if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); // แปลงเป็นจำนวนเต็ม

    // เตรียมคำสั่งเพื่อลบข้อมูลพนักงาน
    $delete_query = "DELETE FROM user_table WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) { // ตรวจสอบว่าการเตรียมคำสั่งสำเร็จ
        mysqli_stmt_bind_param($stmt, "i", $user_id); // ผูกตัวแปร
        mysqli_stmt_execute($stmt); // ประมวลผลคำสั่ง

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: member.php?do=success"); // ถ้าลบสำเร็จ
        } else {
            header("Location: member.php?do=f"); // ถ้าลบไม่สำเร็จ
        }
        mysqli_stmt_close($stmt); // ปิดคำสั่ง
    } else {
        die("Error preparing statement: " . mysqli_error($con)); // แสดงข้อความเมื่อเตรียมคำสั่งไม่สำเร็จ
    }
} else {
    header("Location: member.php");
    exit();
}


?>
