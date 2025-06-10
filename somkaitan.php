<?php
session_start();

include('db_connection.php');


if (!isset($_SESSION['user_id'])) {
    session_unset(); 
    session_destroy(); 
} else {
    $user_id = $_SESSION['user_id'];
    $user_name = isset($_SESSION['username']) ? $_SESSION['username'] : '';
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lemon Shop</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/lemonlonglong.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>


    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================

  ======================================================== -->
</head>

<body class="index-page">

   
   <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename"><img src="assets/img/lemonlonglong.png" class="img-fluid animated" alt=""
            style="height: 50px; width: 50px;">Lemon Shop</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">หน้าเเรก<br></a></li>
          <li><a href="somkaitan.php">บริการสุ่มไก่ตัน<br></a></li>
          <li><a href="kaitan.php">บริการขายไก่ตัน<br></a></li>
          <li><a href="farmgame.php">บริการรับฟาร์ม<br></a></li>




          <?php if (isset($_SESSION) && isset($_SESSION['username'])): ?>
          <div class="dropdown">
            <a class="btn-getstarted" href="#">
              <?php
            // ตรวจสอบและดึงข้อมูลเครดิตของผู้ใช้
            $stmt = $pdo->prepare("SELECT credit_balance FROM users WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();

            if ($user) {
                echo '<span class="credit-text">' . ($user['credit_balance'] ?? 0) . ' บาท</span>';
            } else {
                echo '<span class="credit-text">ไม่พบข้อมูลผู้ใช้</span>';
            }
            ?>
            </a>
            <!-- Dropdown เมนู -->

            <div class="dropdown-content">
              <a href="redeem.php" class="dropdown-link">เติมเงิน</a>
              <a href="logout.php" class="dropdown-link">ออกจากระบบ</a>
            </div>
          </div>
          <?php else: ?>
          <!-- แสดงปุ่มสำหรับผู้ที่ยังไม่ได้เข้าสู่ระบบ -->

          <a class="btn-getstarted" href="login.php">เข้าสู่ระบบ</a>
          <a class="btn-getstarted" style="color: rgb(206, 70, 52);" href="register.php">สมัครสมาชิก</a>

          <?php endif; ?>

        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>


    </div>

  </header>

     <main class="main">



    <section id="services" class="services section">
<style>
  /* General styling for the section */
  .section-title h2 {
    font-size: 40px;
    color: #343a40;
    text-align: center;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 50px;
    position: relative;
  }

  /* Service item container */
  .service-item {
    background: white;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    position: relative;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s, box-shadow 0.4s;
  }

  .service-item:hover {
    transform: translateY(-10px);
    box-shadow: 0px 15px 40px rgba(0, 0, 0, 0.2);
  }

  /* Service icon */
  .service-icon {
    width: 150px;
    height: 150px;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    background: #f8f9fa;
  }

  .service-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
  }

  /* Title styling */
  .service-item h4 a {
    font-size: 22px;
    color: #343a40;
    text-decoration: none;
    font-weight: bold;
    display: block;
    margin-top: 15px;
    transition: color 0.3s;
  }

  .service-item h4 a:hover {
    color: #4a63ff;
  }

  /* Description styling */
  .service-item p {
    font-size: 16px;
    color: #666;
    margin-top: 10px;
    line-height: 1.8;
  }

  /* Responsive design */
  @media (max-width: 768px) {
    .service-item {
      margin-bottom: 30px;
    }

    .service-icon {
      width: 100px;
      height: 100px;
    }

    .service-item h4 a {
      font-size: 18px;
    }
  }
</style>

  <!-- Section Title -->
  <div class="container" data-aos="fade-up">
    <h2>บริการสุ่มไก่ตัน</h2>
    <p>เลือกประเภทไก่ตันที่คุณต้องการ พร้อมรับบริการที่ดีที่สุดจากเรา!</p>
  </div>

  <div class="container">
    <div class="row gy-4">
      <!-- Service Item: ไก่ตันธรรมดา -->
      <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="service-icon">
            <img src="assets/img/gamepass.png" alt="ไก่ตันธรรมดา">
          </div>
          <h4><a href="normal-chicken.php" class="stretched-link">ไก่ตันธรรมดา</a></h4>
          <p>ไก่ตันมาตรฐานสำหรับผู้เล่นที่ต้องการความมั่นคงและประหยัดเวลา
            เราช่วยคุณให้ไปถึงเป้าหมายในเกมอย่างง่ายดาย</p>
        </div>
      </div>

      <!-- Service Item: ไก่ตันเทพ -->
      <div class="col-xl-6 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="service-icon">
            <img src="assets/img/gamepass.png" alt="ไก่ตันเทพ">
          </div>
          <h4><a href="ultimate-chicken.php" class="stretched-link">ไก่ตันเทพ</a></h4>
          <p>สัมผัสประสบการณ์ที่ดีที่สุดกับไก่ตันระดับเทพ เหมาะสำหรับผู้เล่นที่ต้องการพลังและความได้เปรียบเหนือคู่แข่ง</p>
        </div>
      </div>
    </div>
  </div>
</section>








    </main>
    <footer id="footer" class="footer">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Vesperr</strong> <span>All Rights
                        Reserved</span>
                </p>
            </div>
            <div class="social-links d-flex justify-content-center">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>