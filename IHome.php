<?php
session_start();
include('connect.php');
if(!isset($_SESSION['userID'] )){
 
   header("Location:login.html");
   exit();
}
if($_SESSION['Role'] !== 'Instructor')
{
 
   header("Location:login.html");
   exit();
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Intsrutor Home Page</title>
	
	<link href="css/apps.css" rel="stylesheet">
    <link href="css/square/green.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body class="pos_r">	
	<div class="header of_hidden">
		<div class="l_logo">
			<a href="javascript:;" class="top_logo"><img src="images/logo.png" /></a>
		</div>
		<div class="r_menu">
			<ul>
						<li style="background:#0081cd" ><a href="javascript:;"><img src="images/icon_1.png" /><span><b>Home Page</b></span></a></li>
			<li><a href="IRequest.php"><img src="images/icon_2.png" /><span><b>My Test Request</b></span></a></li>
			<li  ><a href="ISchedul.php"><img src="images/icon_3.png" /><span><b>Request Test Scheduling</b></span></a>
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
				<div class="l_msg2">Instructor</div>       
				<div class="l_msg3"> <?php 
				if(isset($_SESSION['firstName'])){ 
   			    echo $_SESSION['firstName'].' '.$_SESSION['lastName']; }
				?></div>
			</div>
			<div class="main_content">
				<h2>My Requests</h2>
				<table class="table table-striped table-bordered table-hover">
					<thead>
					  <tr>
						<th>Test ID</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Status</th>
						<th>Addition</th>
					  </tr>
					</thead>
					<tbody>
					  <?php
							$uid = $_SESSION['userID'];
							$sql = "select * from test where ID_INSTRUCTOR='$uid' order by endtime";
							$result = mysql_query($sql);
							$times = 0;
							while ($times<5){
								$times += 1;
								$row = mysql_fetch_assoc($result);
								if($row == null) break;
								$tid = $row['ID_TEST'];
								$start = $row['StartTime'];
								$end = $row['EndTime'];
								$status = $row['Status'];
								$cid = $row['ID_CLASS'];
								$duration = $row['Duration'];
							
								echo "<tr>";
								echo "<td><a href='ITestDetail.php?tid=".$tid."'>$tid</a></td>";
								echo "<td>$start</td>";
								echo "<td>$end</td>";
								if($status==null){	//pending request
									echo "<td><font color='orange'>Pending</font></td>";
									//echo "<td><a href='Icancel.php?tid=".$tid."'>Cancel</a></td>";
								?>
									<td><a href="Icancel.php?tid=<?php echo $tid; ?>" onclick="return confirm('Are you sure to CANCEL request: <?php echo $tid; ?>?');">Cancel Request</a></td>
								<?php
								}
								elseif($status==0){//denied request
									echo "<td><font color='red'>Denied</font></td>";
									echo "<td><a href='ISchedul.php'>Reschedule</a></td>";
								}
								elseif($status==1){//approved request
									if($cid!=null){//course, use ID_CLASS
										$sql = "select * from roster where ID_TEST='$cid'";
									}
									else
									{//ad hoc, use ID_TEST
										$sql = "select * from roster where ID_TEST='$tid'";
									}
									$num = mysql_query($sql);
									$total = mysql_num_rows($num);
									
									$sql = "select * from appointment where ID_TEST='$tid' and Status=1";//Status=1 means attended and finished test
									$num = mysql_query($sql);
									$att = mysql_num_rows($num);
									
									$IDetailApp = 'IDetailApp.php?tid='.$tid.'&dur='.$duration;
								// $IDetailApp = 'IDetailApp.php?tid='.$tid.'&cid='.$cid.'&dur='.$duration;
									echo "<td><font color='green'>Approved</font></td>";
									echo "<td><a href=$IDetailApp>$att attended / $total total</a></td>";
								}
								echo "</tr>";
							}
						?>
					</tbody>
			
				</table>
				<div align='right'><a href='IRequest.php'><font color='red'>More...</font></a></div>
				<div align='middle'><form><button class="btn btn-ddd btn-lg btn-block" type='submit' formaction='ISchedul.php'>Submit a new request</button></form></div>
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