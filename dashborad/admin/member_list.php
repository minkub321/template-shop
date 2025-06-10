<?php 
include("condb.php"); // เชื่อมต่อฐานข้อมูล

// คำสั่ง SQL ที่ใช้ดึงข้อมูลเฉพาะที่มี user_role เป็น 'user'
$query_worker = "SELECT * FROM users WHERE user_role = 'user' ORDER BY user_id ASC";

$result = mysqli_query($con, $query_worker);
?>

<table id="example1" class="table table-bordered table-striped dataTable">
    <thead>
        <tr role="row" class="info">   
            <th tabindex="0" rowspan="1" colspan="1" style="width: 5%;">ลำดับ</th>
            <th tabindex="0" rowspan="1" colspan="1" style="width: 15%;">Username</th>
            <th tabindex="0" rowspan="1" colspan="1" style="width: 15%;">email</th>
             <th tabindex="0" rowspan="1" colspan="1" style="width: 10%;">เบอร์โทร</th>   
            <th tabindex="0" rowspan="1" colspan="1" style="width: 15%;">เครดิต</th>
            <th tabindex="0" rowspan="1" colspan="1" style="width: 15%;">สร้างเมื่อ</th>
           
               
            <th tabindex="0" rowspan="1" colspan="1" style="width: 5%;">แก้ไข</th>
            <th tabindex="0" rowspan="1" colspan="1" style="width: 5%;">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1; // เริ่มนับจาก 1
        foreach ($result as $row)  {
        ?> 
        <tr>
             <td><?php echo $i++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
             <td><?php echo  $row['phone_number']; ?></td> 
            <td><?php echo $row['credit_balance']; ?></td> 
            <td><?php echo $row['created_at']; ?></td> 
           
           
            
            <td align="center">
                <a class="btn btn-warning btn-sm" href="edit_member.php?act=edit&user_id=<?php echo $row['user_id']; ?>">แก้ไข</a>
            </td>
            <td align="center">
                <a class="btn btn-danger btn-sm" href="member_del.php?user_id=<?php echo $row['user_id']; ?>" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<style>
    /* Custom Toggle Switch */
    .custom-toggle {
        display: inline-block;
        position: relative;
    }

    .custom-toggle input[type="checkbox"] {
        display: none;
    }

    .custom-toggle label {
        display: inline-flex;
        align-items: center;
        padding: 0.5em 1em;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .toggle-on {
        background-color: #4CAF50;
        color: white;
    }

    .toggle-off {
        background-color: #f44336;
        color: white;
    }

    .custom-toggle i {
        margin-right: 0.5em;
        transition: transform 0.3s ease;
    }

    .custom-toggle input:checked + label i {
        transform: rotate(180deg);
    }
     /* ปรับแต่งปุ่มสีเหลือง */
        .btn-warning {
            background-color: #f1c40f;
            color: #ffffff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        /* เมื่อวางเมาส์บนปุ่มสีเหลือง */
        .btn-warning:hover {
            background-color: #f39c12;
            transform: scale(1.05);
        }

        /* ปรับแต่งปุ่มสีแดง */
        .btn-danger {
            background-color: #e74c3c;
            color: #ffffff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        /* เมื่อวางเมาส์บนปุ่มสีแดง */
        .btn-danger:hover {
            background-color: #c0392b;
            transform: scale(1.05);
        }
</style>

<!-- รวม CSS และ JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
function toggle_check(user_id) {
    const checkbox = document.getElementById(`toggle_${user_id}`);
    const label = checkbox.nextElementSibling;

    // อัพเดทสถานะ
    if (checkbox.checked) {
        label.classList.remove('toggle-off');
        label.classList.add('toggle-on');
        label.innerHTML = '<i class="fas fa-check"></i> Active';
    } else {
        label.classList.remove('toggle-on');
        label.classList.add('toggle-off');
        label.innerHTML = '<i class="fas fa-times"></i> Inactive';
    }

    // ทำการส่งข้อมูลผ่าน AJAX
    
</script>
