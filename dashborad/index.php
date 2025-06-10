<?php
session_start(); // เพิ่ม session_start() ที่ด้านบนสุด
include('condb.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WhatCom</title>
   <link rel="stylesheet" href="../../assets/css/navber.css">
   <link rel="stylesheet" href="../../assets/css/index.css">
  
   <link rel="stylesheet" href="../../assets/css/Footer.css">
   <link rel="stylesheet" href="admin/dist/css/login.css">
   <link rel="icon" type="image/x-icon" href="assets/Img/whatcom.png">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body style="background-color: black;">
   <video width="100%" height="140%" autoplay loop muted plays-inline class="back-video">
      <source src="../../assets/Video/WhatCom.mp4" type="video/mp4">
   </video>

   <div class="containerlogo" onclick="myFunction()">
               <div class="logoimg">
                  <img src="../../assets/Img/whatcom.png" alt="">
               </div>
               <div class="contentText">
                  <h1 data-lang="en">The Online</h1>
                  <p data-lang="en">Manual of Printer</p>

                
               </div>
               <script>
                  function myFunction() {
                     location.replace("../../index.php")
                  }
               </script>
    </div>

   <body>
     <form class="form" action="check_login.php" method="POST">
   

    <p class="LoginText">Admin System</p>
    <p class="message">Log in now and get full access to your admin</p>

    <label>
        <input required type="text" class="input" name="username" placeholder="Username">
    </label>

    <label>
        <input required type="password" class="input" name="password" placeholder="Password"> 
    </label>

    <button class="submit" name="login_user">Submit</button>

  
</form>
   </body>

</html>