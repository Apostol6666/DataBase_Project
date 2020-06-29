<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Site</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700&display=swap" rel="stylesheet">
  <style>
    .buttonmus {width:64px; height:64px; background: transparent url('mus.png') 0% 0% no-repeat padding-box; background-size:64px 64px;
     background-position:center center; border:0px; margin-left:20px; margin-top:12px;}
    .form{margin-left: 95px;}
     html {background:#1b1b1b; color:white;}
    .hClass {font-size: 45px; color:  #ACA9D0; text-align: right; margin-left:750px; display:inline;}
    .admin_zone {font-size: 40px; color:  #ACA9D0; margin-left: 95px; margin-bottom:0px; margin-top:100px;}
    .ptext {font-size: 30px; color: #ACA9D0; margin-left: 65px; margin-top:60px;font-family:inherit;font-weight:bold;}
    .formsess {margin-left:65px;}
    .left {margin-top: 30px; height: 33px; width: 200px;margin-left:65px;}
    .admin_form {margin-top: 5px; margin-bottom:50px;margin-left:80px;}
    .dateform {min-width:300px;max-width:500px; display:inline-block;}
    .timeform {min-width:239px;max-width:400px;display:inline-block;}
    .topicform {min-width:550px;max-width:800px;display:inline-block;}
    .topicinp {min-width:500px;}
    .formtype {display:inline-block;}
  </style>
</head>
  
<body>
  	<button class="buttonmus" type="button" onclick="new Audio('old_road.mp3').play()"> </button>
    <!--<p class="name"> <strong class="light"> New Page </strong> </p>-->
      <!--phpinfo()-->
      <?php $session_lifetime = 200; session_set_cookie_params ($session_lifetime); session_start(); ?>
      <?php include ('form.php'); ?>
  		<?php include ('formview.php'); ?>
  		<?php include ('admin.php'); ?>
      <!-- php include ('admin.php'); ?> -->
</body>
  
</html>
