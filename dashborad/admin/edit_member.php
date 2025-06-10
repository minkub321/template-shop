<?php
include('condb.php');

// Check if 'user_id' is set in the query string
if (isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
    $from_page = isset($_GET['from']) ? $_GET['from'] : 'member.php';

    // Retrieve existing user data
    $query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "ไม่พบข้อมูลผู้ใช้";
        exit();
    }
} else {
    echo "ไม่มีการระบุรหัสผู้ใช้";
    exit();
}

// Update user data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($con, $_POST["user_name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $num_phone = mysqli_real_escape_string($con, $_POST["num_phone"]);
    $date_birth = mysqli_real_escape_string($con, $_POST["date_birth"]);
    $G_ender = mysqli_real_escape_string($con, $_POST["G_ender"]);
    $A_ddress = mysqli_real_escape_string($con, $_POST["A_ddress"]);
    $user_level = mysqli_real_escape_string($con, $_POST["user_level"]);
    $user_status = mysqli_real_escape_string($con, $_POST["user_status"]);
    $from_page = $_POST["from_page"];

    // Update query
    $stmt = $con->prepare("UPDATE user_table SET user_name=?, email=?, num_phone=?, date_birth=?, G_ender=?, A_ddress=?, user_level=?, user_status=? WHERE user_id=?");
    $stmt->bind_param("ssssssssi", $user_name, $email, $num_phone, $date_birth, $G_ender, $A_ddress, $user_level, $user_status, $user_id);
    
    if ($stmt->execute()) {
        // Redirect back to the original page after a successful update
        header("Location: $from_page");
        exit();
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการอัปเดตข้อมูล");</script>';
    }
    $stmt->close();
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลผู้ใช้</title>
    <!-- Your existing CSS code goes here -->
</head>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f1f1f1, #d4e9f9);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: #34495e;
    }
    .form-container {
        width: 100%;
        max-width: 320px; /* ลดขนาดฟอร์ม */
        padding: 15px; /* ลด padding */
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 15px;
        font-size: 1.5em;
    }
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        color: #2c3e50;
        font-size: 0.9em;
    }
    input[type="text"], input[type="email"], input[type="date"], select {
        width: 100%;
        padding: 6px;
        margin-bottom: 12px;
        border: 1px solid #dcdcdc;
        border-radius: 6px;
        font-size: 0.9em;
        color: #34495e;
        background-color: #f9f9f9;
    }
    .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    .checkbox-container input[type="checkbox"] {
        margin-right: 8px;
        transform: scale(1.1);
    }
    .button-container {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-top: 15px;
    }
    .button-container button, .button-container a {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 0.9em;
        cursor: pointer;
        color: #ffffff;
        text-align: center;
        transition: background-color 0.3s;
    }
    .save-btn {
        background-color: #74b9ff;
    }
    .save-btn:hover {
        background-color: #3498db;
    }
    .cancel-btn {
        background-color: #ff7675;
    }
    .cancel-btn:hover {
        background-color: #e74c3c;
    }
</style>


<body>
    <div class="form-container">
        <h2>แก้ไขข้อมูลผู้ใช้</h2>
        <form action="" method="post">
            <input type="hidden" name="from_page" value="<?php echo htmlspecialchars($from_page ?? '', ENT_QUOTES, 'UTF-8'); ?>">

            <label>ชื่อผู้ใช้:</label>
            <input type="text" name="user_name" value="<?php echo htmlspecialchars($user['user_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>อีเมล:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>เบอร์โทร:</label>
            <input type="text" name="num_phone" value="<?php echo htmlspecialchars($user['num_phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required pattern="[0-9]{10}">

            <label>วันเกิด:</label>
            <input type="date" name="date_birth" value="<?php echo htmlspecialchars($user['date_birth'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>เพศ:</label>
            <select name="G_ender" required>
                <option value="Male" <?php if (($user['G_ender'] ?? '') == 'M') echo 'selected'; ?>>ชาย</option>
                <option value="Female" <?php if (($user['G_ender'] ?? '') == 'F') echo 'selected'; ?>>หญิง</option>
            </select>

            <label>ที่อยู่:</label>
            <input type="text" name="A_ddress" value="<?php echo htmlspecialchars($user['A_ddress'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>ระดับผู้ใช้:</label>
            <input type="text" name="user_level" value="<?php echo htmlspecialchars($user['user_level'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <label>สถานะผู้ใช้:</label>
            <input type="text" name="user_status" value="<?php echo htmlspecialchars($user['user_status'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>

            <div class="button-container">
                <button type="submit" class="save-btn">บันทึกการแก้ไข</button>
                <a href="<?php echo htmlspecialchars($from_page ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="cancel-btn">ยกเลิก</a>
            </div>
        </form>
    </div>
</body>
</html>
