<?PHP
	#<!-- Log -->
	include('log4php/Logger.php');
	Logger::configure('log4php.xml');
	$log = Logger::getLogger('myLogger');
	
    session_start();
#	$is_ajax = $_REQUEST['is_ajax'];
#	if(isset($is_ajax) && $is_ajax)
{
    include('connect.php');//connect database
    
	//construct the tid AND insert into table test for the course: CSE308-01_1158_ex3
	$idC = $_REQUEST['idC'];
	$sectionC = $_REQUEST['sectionC'];
	$termC = $_REQUEST['termC'];
	$sub = $idC[0].$idC[1].$idC[2];
	$catNo = $idC[3].$idC[4].$idC[5];
	//query the course id
	$sql = "select * from course where Subject='$sub' AND CatalogNumber='$catNo' AND Section='$sectionC' AND Term='$termC'";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	$row = mysql_fetch_assoc($result) or die('Error: '.mysql_error());
	$idclass=$row['ID_CLASS'];
	
	//query the number of tests this course has to make the test number _ex$num
	$sql = "select * from test where ID_CLASS='$idclass'";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	$num = mysql_num_rows($result) or die('Error: '.mysql_error());
	$num=$num+1;//_ex$num for ID_TEST
	
	$idtest = $idC.'-'.$sectionC.'_'.$termC.'_ex'.$num;
	
	$startDTL = strtotime($_REQUEST['startDTC']);
	$startDT = date("Y-m-d H:i:s",$startDTL);
	$endDTL = strtotime($_REQUEST['endDTC']);
	$endDT = date("Y-m-d H:i:s",$endDTL);
	
	$duration = $_REQUEST['durationC'];
	$idins = $_SESSION['userID'];

	$sql = "insert into test value('$idtest','$startDT','$endDT','$duration',null,'$idins','$idclass')";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	if($result)
	{
		// $log->info("Request ID: $idtest is inserted into test. ");
		echo "Request ID: $idtest is submitted. Please wait for approval.\r\n";
		echo "<a href=IHome.php>Home Page</a>";
	}
	else{
		echo "Request ID: $idtest cannot submit";
	}
	
	mysql_close($con);//close db
}
?>