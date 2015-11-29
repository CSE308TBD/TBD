<?php
session_start();
include('connect.php');
//date_default_timezone_set('PRC');
date_default_timezone_set('America/New_York'); 
error_reporting(0);
if(!isset($_SESSION['userID'])){
  // echo 'Please Log in!';
   header("Location:login.html");
   exit();
}if($_SESSION['Role'] !== 'Administrator')
{
 
   header("Location:login.html");
   exit();
}

if( isset($_POST['id']) && $_POST['id'] ) {
	$buffer = mysql_query("select * from appointment where ID_STUDENT = '$_POST[id]' limit 1");
	$row = mysql_fetch_array($buffer);
	if( !$row ) {
		echo '-1||Please enter a valid ID.';
		exit;
	}
	if( isset($_POST['f']) ) {
		mysql_query("update appointment set status = 1 where AppointmentId = '$row[AppointmentId]'");
		echo '1||'.$_POST['id'].', check-in successful! Your seat No. is: '.$row['SeatNO'];
		exit;
	}
	if( time() >= strtotime($row['StartTime']) - 60*30 && time() <= strtotime($row['StartTime']) + 60*30 &&  $row['Status'] == 0) {
		mysql_query("update appointment set status = 1 where AppointmentId = '$row[AppointmentId]'");
		echo '1||'.$_POST['id'].', check-in successful! Your seat No. is: '.$row['SeatNO'];
		exit;
	}
	$timenow = time();
	
	$buffer = mysql_query("select * from appointment where ID_STUDENT = '$_POST[id]' order by AppointmentId desc");
	$list = array();
	while($row = mysql_fetch_array($buffer)){
		$list[] = $row;
	}
	$table = '<table cellspacing="0" cellpadding="0" bordercolor="#ecbf8a" border="1" align="center" class="cal-table"><thead><tr><th style="width: 126px">Appointment ID</th><th style="width: 170px">COURCE</th><th style="">Start Time</th><th>Seat No.</th><th>Check-in</th></tr></thead><tbody>';
	if( $list ) {
		foreach($list as $row){
			$course = '';
			if( $row['ID_TEST'] ) {
				$buffer = mysql_query("select * from test where ID_TEST = '$row[ID_TEST]' limit 1");
				$rs = mysql_fetch_array($buffer);
				$course = $rs['ID_TEST'];
			}else{
				$course = '';
			}
			if( strtotime($row['StartTime']) >= time() ) {
				if( $row['Status'] == 0){
				$op = '<font color="red"><a href="javascript:void(0)" style="color:red" onclick="sign(\''.$row['ID_STUDENT'].'\');">Manual Check-in</a></font>';}
				else{
				$op = '<font color="gray">Checked</font>';
			}
			}
			else{
				$op = '<font color="gray">Checked</font>';
			}
			$table .= '<tr><td>'.$row['AppointmentId'].'</td><td>'.$course.'</td><td>'.$row['StartTime'].'</td><td>'.$row['SeatNO'].'</td><td>'.$op.'</td></tr>';
		}
	}
	$table .= '</tbody></table>';
	echo '2||<font color="red">'.$_POST['id'].', you do not have any appointment now, here are all your appointments:</font>'.$table;

	exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Appointment</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
	<style>
	 .cal-table {
    background: #3eabe7  none repeat scroll 0 0;
    border: 1px solid #3eabe7;
    color: #000000;
    font-family: 新宋体;
    font-size: 14px;
    margin-top: 10px;
    width: 771px;
}
table, tr, td {
    border-collapse: collapse;
    border-spacing: 0;
    margin: 0;
    padding: 0;
}
.cal-table td {
    background: #ffffff none repeat scroll 0 0;
    height: 32px;
    text-align: center;
}
.cal-table th {
    background: #3eabe7 none repeat scroll 0 0;
    height: 40px;
	text-align:center;
	color:#FFFFFF;
}
</style>
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
			<li  ><a href="ARequest.php"><img src="images/icon_3.png" /><span><b>Test Request</b></span></a></li>
			<li style="background:#0081cd"><a href="javascript:;"><img src="images/icon_4.png" /><span><b>Appointment</b></span></a></li>
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
			<div class="main_content" style="padding:10px;">
			<?php  	
			echo date("Y-m-d H:i:s");
	
			?>
			<form id="signForm">
				ID:&nbsp;<input type="text" name="id" value="" id="id" /><br/><br/>
				<input type="button" id="signBtn" value="Check-in" style="margin-left:20px;" />
				<div class="msg" style="margin-top:20px;margin-left:20px;"></div>
			</form>
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

	$("#signBtn").click(function(){
		jQuery.ajax({
            url: 'AApp.php',
            data: $('#signForm').serialize(),
            type: "POST",
            beforeSend: function(){
                if( $("#id").val() == ''  ) {
                    alert('Please enter your ID！');
                    return false;
                }
            },
            success: function(msg) {
                var data = msg.split('||');
                if(data[0] == -1){
                    $(".msg").html('<font color="red">'+data[1]+'</font>');
                }else if(data[0] == 1){
                    $(".msg").html('<font color="green">'+data[1]+'</font>');
                }else if(data[0] == 2){
                    $(".msg").html(data[1]);
                }
            }
        });
        return false;
	});
	function sign(id){
		jQuery.ajax({
            url: 'AApp.php',
            data: "f=1&id="+id,
            type: "POST",
            success: function(msg) {
                var data = msg.split('||');
                $(".msg").html('<font color="green">'+data[1]+'</font>');               
            }
        });
        return false;
	}
	</script>
</body>
</html>