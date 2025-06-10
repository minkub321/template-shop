<?php
session_start();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar" style="min-height: 100vh; background: linear-gradient(180deg, #1e293b, #0f172a); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);">
  <link rel="stylesheet" href="dist/css/style.css">
  <a href="index3.html" class="brand-link text-center py-3" style="background: #334155; color: #fff; font-weight: bold; font-size: 18px; text-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);">
    Repair System
  </a>

  <div class="sidebar">
    <div class="user-panel d-flex align-items-center py-4 px-3" style="background: #1e293b; border-bottom: 1px solid #64748b;">
      <div class="image me-2">
        <img src="../admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" style="width: 50px; height: 50px; border: 2px solid #94a3b8; transition: transform 0.3s ease;">
      </div>
      <div class="info">
        <a href="index.php" class="d-block text-white fw-bold">คุณ <?php echo $_SESSION["username"]; ?></a>
        <span class="text-light small">สถานะ: <?php echo $_SESSION["user_level"]; ?></span>
      </div>
    </div>

    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
       
       <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($menu == 'index') { echo 'active'; } ?>" 
             style="color: #e2e8f0; transition: all 0.3s; padding: 10px 15px; border-radius: 8px;">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>ประวัติการสั้่งซื้อ</p>
          </a>
        </li>

        <li class="nav-header text-uppercase text-light fs-6 fw-bold px-3 mt-3" style="color: #94a3b8;">จัดการสมาชิกเเละสินค้า</li>
      
       
        <li class="nav-item">
          <a href="member.php" class="nav-link <?php if ($menu == 'member') { echo 'active'; } ?>" 
             style="color: #e2e8f0; transition: all 0.3s; padding: 10px 15px; border-radius: 8px;">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>จัดการข้อมูลสมาชิก</p>
          </a>
        </li>
         <li class="nav-item">
          <a href="employee.php" class="nav-link <?php if ($menu == 'employee') { echo 'active'; } ?>" 
             style="color: #e2e8f0; transition: all 0.3s; padding: 10px 15px; border-radius: 8px;">
            <i class="nav-icon fas fa-users"></i>
            <p>จัดการข้อมูลพนักงาน</p>
          </a>
        </li>

        <li class="nav-header text-uppercase text-light fs-6 fw-bold px-3 mt-3" style="color: #94a3b8;">ออกจากระบบ</li>
        <li class="nav-item">
          <a href="../logout.php" class="nav-link text-danger" onclick="return confirm('ยืนยันออกจากระบบ !!');" 
             style="transition: all 0.3s; padding: 10px 15px; border-radius: 8px;">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
