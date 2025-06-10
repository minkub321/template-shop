<!DOCTYPE html>
<html lang="en">
<?php $menu = "index";?>
<?php include("head.php"); ?> 

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
 
  <!-- /.navbar -->
  <?php include("menu.php"); ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
      if (@$_GET['do'] == 'success') {
        echo '<script type="text/javascript">swal("", "มอบงานเรียบร้อย !!", "success");</script>';
        echo '<meta http-equiv="refresh" content="1;url=index.php" />';
      } 
      
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
          <!-- ./col -->
           <div class="col-md-12">
            <?php 
            $act = (isset($_GET['act']) ? $_GET['act'] : '');
            if ($act == 'add') {
            include('case_give_work.php');
            }elseif ($act == 'edit') {
            include('');
            }
            else{
            include('case_list.php'); 
            }
            ?>
          </div>
        </div>
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("footer.php"); ?> 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  <?php include("script.php"); ?> 
</body>
</html>
