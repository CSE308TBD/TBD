<?php
session_start();
include('connect.php');
include('ITermSwitch.php');
if(!isset($_SESSION['userID'])){
  // echo 'Please Log in!';
   header("Location:login.html");
   exit();
}if($_SESSION['Role'] !== 'Instructor')
{
 
   header("Location:login.html");
   exit();
}
	include('log4php/Logger.php');
	Logger::configure('log4php.xml');
	$log = Logger::getLogger('myLogger');
/*	$log->debug("debug_log");
	$log->info("info_log");
	$log->warn('warn_log');
	$log->error("error_log");
	$log->fatal("fatal_log");
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Schedul Test Request</title>
	
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
			<li><a href="IRequest.php"><img src="images/icon_2.png" /><span><b>My Test Request</b></span></a></li>
			<li style="background:#0081cd"  ><a href="javascript:;"><img src="images/icon_3.png" /><span><b>Request Test Scheduling</b></span></a>
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
			
				<div id="scheduler">
					<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
						<ul id="myTabs" class="nav navg-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Course</a></li>
							<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Ad Hoc</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">
								<div id="scheduler_course">
									<form id="SchedulerC" name="SchedulerC" action="IqueryC.php" method="post" >
										<table>
											<tr>
												<td>Course ID</td>
												<td><input type="text" id="idC" name="idC"></td>
											</tr>
											<tr>
												<td>Section</td>
												<td><input type="text" id="sectionC" name="sectionC"></td>
											</tr>
											<tr>
												<td>Term</td>
												<!--term code: Fall 2015 is 1158, Winter 2016 is 1161, Spring 2016 is 1164, Summer 2016 is 1166 and Fall 2016 is 1168-->
												<td><?php
														$sql="select term from testcenterinfo";
														$result = mysql_query($sql) or die('Error: '.mysql_error());//sql
													?>
													<select name='termC'>
													<?php while($row=mysql_fetch_assoc($result)){ ?> 
													<option value= <?php echo $row['term'] ?> ><?php echo termSwitch($row['term']) ?></option><?php } ?>
												</td>
											</tr>
											<tr>
												<td>Duration(min)</td>
												<td><input type="text" id="durationC" name="durationC"></td>
											</tr>
											<tr>
												<td>Start Date and Time</td>
												<td><input type="datetime-local" id="startDTC" name="startDTC" min="<?php date_default_timezone_set('America/New_York'); echo date("Y-m-d\TH:i",time())?>" value="<?php echo date("Y-m-d\TH:i",time()); ?>" ></td>
											</tr>
											<tr>
												<td>End Date and Time</td>
												<td><input type="datetime-local" id="endDTC" name="endDTC" min="<?php echo date("Y-m-d\TH:i",time())?>" value="<?php echo date("Y-m-d\TH:i",time()); ?>"></td>
											</tr>
										</table>
										<input type="submit" class="btn btn-ddd btn-lg btn-block" name="submitC" value="Submit" id="submitC">
									</form>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">
								<div id="adhoc">
									<form id="SchedulerAH" name="SchedulerAH" action="IqueryAH.php" method="post" >
										<table>
											<tr>
												<td>Test Name</td>
												<td><input type="text" id="idAH" name="idAH"></td>
											</tr>
											<tr>
												<td>Duration(min)</td>
												<td><input type="text" id="durationAH" name="durationAH"></td>
											</tr>
											<tr>
												<td>Start Date and Time</td>
												<td><input type="datetime-local" id="startDTAH" name="startDTAH" min="<?php echo date("Y-m-d\TH:i",time())?>" value="<?php echo date("Y-m-d\TH:i",time()); ?>" ></td>
											</tr>
											<tr>
												<td>End Date and Time</td>
												<td><input type="datetime-local" id="endDTAH" name="endDTAH" min="<?php echo date("Y-m-d\TH:i",time())?>" value="<?php echo date("Y-m-d\TH:i",time()); ?>"></td>
											</tr>
											<tr>
												<td>Student List</td>
												<td><textarea id='studentL' name='studentL' form='SchedulerAH' rows="10" cols="60" placeholder="Format for one person per line: NetID, LastName, FirstName"></textarea></td>
											</tr>
										</table>
										<input type="submit" class="btn btn-ddd btn-lg btn-block" name="submitAH" value="Submit" id="submitAH">
									</form>
								</div>
							</div>
						  </div>
					</div>
				</div>
				
				
				
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
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>