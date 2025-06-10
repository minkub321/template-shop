<!DOCTYPE html>
<html lang="en">
<?php $menu = "member"; ?>
<?php include("head.php"); ?> 

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 
  <?php include("menu.php"); ?> 

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">จัดการข้อมูลสมาชิก</h1>
      </div>
    </div>

    <?php 
      if (isset($_GET['do'])) {
        if ($_GET['do'] == 'success') {
          echo '<script type="text/javascript">swal("", "ทำรายการสำเร็จ !!", "success");</script>';
          echo '<meta http-equiv="refresh" content="1;url=member.php" />';
        } elseif ($_GET['do'] == 'f') {
          echo '<script type="text/javascript">swal("", "ผิดพลาด !!", "error");</script>';
          echo '<meta http-equiv="refresh" content="1;url=member.php" />';
        } 
      }
    ?>

    <section class="content">
      <div class="container-fluid">
        <button type="button" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#myModal"> + เพิ่มข้อมูล </button>

        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form action="member_db.php" method="post" accept-charset="utf-8">
                <div class="modal-header">
                  <h4 class="modal-title">เพิ่มข้อมูล|จัดการข้อมูลสมาชิก</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="user_name">ชื่อผู้ใช้:</label>
                      <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="date_birth">วันเกิด:</label>
                      <input type="date" name="date_birth" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="num_phone">เบอร์โทร:</label>
                      <input type="text" name="num_phone" class="form-control" required pattern="[0-9]{10}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">อีเมล์:</label>
                      <input type="email" name="email" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="A_ddress">ที่อยู่:</label>
                      <input type="text" name="A_ddress" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password">รหัสผ่าน:</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="user_level">ระดับผู้ใช้:</label>
                      <select name="user_level" class="form-control" required>
                        <option value="member">-user-</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="G_ender">เพศ:</label>
                      <select name="G_ender" class="form-control" required>
                        <option value="Male">ชาย</option>
                        <option value="Female">หญิง</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">บันทึก</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <?php include('member_list.php'); ?>
        </div>
      </div>
    </section>
  </div>

  <?php include("footer.php"); ?> 
  <?php include("script.php"); ?> 
</body>
</html>
