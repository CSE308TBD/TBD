<?php
session_start();
include('connect.php');
if(!isset($_SESSION['userID'])){
  // echo 'Please Log in!';
   header("Location:login.html");
   exit();
}if($_SESSION['Role'] !== 'Student')
{
 
   header("Location:login.html");
   exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Make Appointment</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
</head>
<body class="pos_r">	
	<div class="header of_hidden">
		<div class="l_logo">
			<a href="javascript:;" class="top_logo"><img src="images/logo.png" /></a>
		</div>
		<div class="r_menu">
			<ul>
						<li ><a href="SHome.php"><img src="images/icon_1.png" /><span><b>Home Page</b></span></a></li>
			<li  ><a href="SApp.php"><img src="images/icon_2.png" /><span><b>My Appointment</b></span></a></li>
			<li style="background:#0081cd" ><a href="javascript:;"><img src="images/icon_3.png" /><span><b>Make Appointmentg</b></span></a>
            </li>
            <li></li>
            <li></li>
			<li></li>
            <li></li>
			<li><a href="logout.php"><img src="images/icon_8.png" /><span><b>Log out</b></span></a></li>
			</ul>
		</div>
	</div>
	<div class="wrap">
		<div class="full_wrap">
			<div class="left_side">
				<div class="l_msg1">Welcome</div>
				<div class="l_msg2">Student</div>
				<div class="l_msg3"> <?php 
				if(isset($_SESSION['firstName'])){ 
   			    echo $_SESSION['firstName'].' '.$_SESSION['lastName']; }
				?></div>
			</div>
			<div class="main_content">
			</div>
		</div>	
	</div>	
	<div class="footer">
		<div class="container">		
			<p>Copyright<span>©</span>  2015 Test Center</p>
		</div>
	</div>
	<script>
	var _w_h = $(window).height()-$('.header').outerHeight(true)-$('.footer').outerHeight(true);
	$('.wrap').css('min-height',_w_h+'px');
	$(window).resize(function(){	
		var _w_h = $(window).height()-$('.header').outerHeight(true)-$('.footer').outerHeight(true);
		$('.wrap').css('min-height',_w_h+'px');
	});
	</script>
</body>
</html>