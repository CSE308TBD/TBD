<?php
session_start();
include('connect.php');
if(!isset($_SESSION['userID'])){
  // echo 'Please Log in!';
   header("Location:login.html");
   exit();
}
if($_SESSION['Role'] !== 'Administrator')
{
 
   header("Location:login.html");
   exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Test Request</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
</head>
<body class="pos_r">	
	<div class="header of_hidden">
		<div class="l_logo">
			<a href="javascript:;" class="top_logo"><img src="images/logo.png" /></a>
		</div>
		<div class="r_menu">
			<ul>
			<li  ><a href="AHome.php"><img src="images/icon_1.png" /><span><b>Home Page</b></span></a></li>
			<li><a href="AInfo.php"><img src="images/icon_2.png" /><span><b>Test Center Information</b></span></a></li>
			<li  style="background:#0081cd"><a href="javascript:;"><img src="images/icon_3.png" /><span><b>Test Request</b></span></a></li>
			<li><a href="AApp.php"><img src="images/icon_4.png" /><span><b>Appointment</b></span></a></li>
			<li><a href="AReport.php"><img src="images/icon_5.png" /><span><b>Generate Reports</b></span></a></li>
			<li><a href="AData.php"><img src="images/icon_6.png" /><span><b>Import DATA</b></span></a></li>
			<li><a href="AUtili.php"><img src="images/icon_7.png" /><span><b>Display  Utilization</b></span></a></li>
			<li><a href="logout.php"><img src="images/icon_8.png" /><span><b>Log out</b></span></a></li>
			</ul>
		</div>
	</div>
	<div class="wrap">
		<div class="full_wrap">
			<div class="left_side">
				<div class="l_msg1">Welcome</div>
				<div class="l_msg2">Administrator</div>
				<div class="l_msg3"> <?php 
				if(isset($_SESSION['firstName'])){ 
   			    echo $_SESSION['firstName'].' '.$_SESSION['lastName']; }
				?></div>
			</div>
			<div class="main_content">
				<h2>Pending Requests</h2>
				<table class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<th>Test ID</th>
						<th>Test Course</th>
						<th>Instructor</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Candidates No.</th>
						<th>Current Utilization</th>
						<th>Utilization with this test</th>
						<th>Actions</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						//query all test
						$sql = "select * from test where Status is null order by StartTime";
						$result = mysql_query($sql);
						while($row = mysql_fetch_assoc($result)){
							$tid = $row['ID_TEST'];
							$cid = $row['ID_CLASS'];
							$iid = $row['ID_INSTRUCTOR'];
							$st = $row['StartTime'];
							$et = $row['EndTime'];
							
							$sql = "select * from roster where ID_TEST='$tid'";
							$canNum = mysql_num_rows(mysql_query($sql));
							
							//Utilization
							$cutil = 'NA';
							$eutil = 'NA';
							
							//output the table html
							?>
							<tr>
								<td><?php echo $tid; ?></td>
								<td><?php echo $cid; ?></td>
								<td><?php echo $iid; ?></td>
								<td><?php echo $st; ?></td>
								<td><?php echo $et; ?></td>
								<td><?php echo $canNum; ?></td>
								<td><?php echo $cutil; ?></td>
								<td><?php echo $eutil; ?></td>
								<td><form><button type='submit' formaction='ARequest_Approve.php'>Approve</button>
										  <button type='submit' formaction='ARequest_Deny.php'>Deny</button></form></td>
							</tr>
							<?php
						}
					?>
					</tbody>
				</table>
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