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
	<title>Test Detail</title>	
	
	<!-- Bootstrap -->
    <link href="css/apps.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/square/green.css" rel="stylesheet">
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
						<li ><a href="IHome.php"><img src="images/icon_1.png" /><span><b>Home Page</b></span></a></li>
			<li style="background:#0081cd"><a href="IRequest.php"><img src="images/icon_2.png" /><span><b>My Test Request</b></span></a></li>
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
				<?php
					$tid = $_GET['tid'];
					$cid = $_GET['cid'];//$cid is the course class id, CSE308-1158
					$dur = $_GET['dur'];//duration
				?>
				<h2>Appointment and Attendance Detail for <?php echo $tid; ?></h2>
				<table class='table table-striped table-bordered table-hover'>
					<tr>
						<th>Student ID</th>
						<th>Student Name</th>
						<th>SeatNO</th>
						<th>Time</th>
						<th>Status</th>
					</tr>
					
				<?php
					//query netid
					if($cid!=null) //course
					{
						$sql = "select * from rosterc where ID_CLASS='$cid'";
					}
					else	//ad hoc
					{
						$sql = "select * from roster where ID_TEST='$tid'";
					}
					$result = mysql_query($sql) or die('Error: '.mysql_error());
					$total = mysql_num_rows($result) or die('Error: '.mysql_error());
					$na = 0;
					$pending = 0;
					$att = 0;
					$ns = 0;
					while($row = mysql_fetch_assoc($result))
					{
						$sid = $row['ID_STUDENT'];
						
						//query student name
						$sql = "select * from users where UserID='$sid'";
						$sinfo = mysql_fetch_assoc(mysql_query($sql) or die('Error: '.mysql_error()));
						$name = $sinfo['FirstName'].' '.$sinfo['LastName'];
						
						echo "<tr><td>$sid</td><td>$name</td>";
						
						//query appointment
						$sql = "select * from appointment where ID_STUDENT='$sid' and ID_TEST='$tid'";
						$ainfo = mysql_fetch_assoc(mysql_query($sql));
						if($ainfo==null)//not make appointment yet
						{
							$na+=1;
							echo "<td><font color='red'>NA</font></td>";
							echo "<td><font color='red'>NA</font></td>";
							echo "<td><font color='red'>NA</font></td>";
						}
						else//appointment made, status: null==Waiting, 1==Finished/Checked in, 0==Not showed
						{
							$startT = date_create($ainfo['StartTime']);
							$dur = $dur.' minutes';
							$endT = date_create($ainfo['StartTime']);
							date_add($endT,date_interval_create_from_date_string($dur));
							$time = $startT->format('Y-m-d<\b\\r>H:i - ').$endT->format('H:i'); 
							
							$seatNO = $ainfo['SeatNO'];
							$status = $ainfo['Status'];
							
							echo "<td>$seatNO</td>";
							echo "<td>$time</td>";
							
							if($status==null){ echo "<td>Waiting</td>"; $pending+=1;}
							elseif($status==1){ echo "<td>Checked in</td>"; $att+=1;}
							elseif($status==0){ echo "<td>Not showed</td>"; $ns+=1;}
						}
						echo "</tr>";
					}
					echo "</table>";
					echo "<div><p>Total $total should attend test $tid</p>";
					echo "Not make appointment: $na</br>";
					echo "Made appointment and waiting to take the test: $pending</br>";
					echo "Made appointment and Checked In: $att</br>";
					echo "Made appointment but Not showed: $ns</div>";
					
					mysql_close($con);//close db
				?>
				
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