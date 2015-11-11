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
    $idtest = $_REQUEST['idAH'];
	$startDTL = strtotime($_REQUEST['startDTAH']);
	$startDT = date("Y-m-d H:i:s",$startDTL);
	$endDTL = strtotime($_REQUEST['endDTAH']);
	$endDT = date("Y-m-d H:i:s",$endDTL);
	$duration = $_REQUEST['durationAH'];
	$idins = $_SESSION['userID'];

	$sql = "insert into test value('$idtest','$startDT','$endDT','$duration',null,'$idins',null)";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	if($result)
	{
		// $log->info("Request ID: $idtest is inserted into test. ");
		echo "Request ID: $idtest is submitted. Please wait for approval.<br>";
		echo "<a href=IHome.php>Home Page</a><br><br>";
		
		$studentlist = explode("\n",$_POST['studentL']);
		if($_POST['studentL']==null) return;
		
		foreach ($studentlist as $student)
		{
			$infoS = explode(", ",$student);
			$ids = $infoS[0];
			$ln = $infoS[1];
			$fn = $infoS[2];
			$sql = "insert into roster value('$idtest','$ids')";	//roster holds id_test and id_student
			$result = mysql_query($sql) or die('Error: '.mysql_error());
			if(!$result)	//create account for those do not have
			{
				$sql = "insert into users value('$ids','$ids','$ln','$fn',null,'Student')";
				$result = mysql_query($sql) or die('Error: '.mysql_error());
				if ($result)
				{
					echo "User Account: $ids is created. Password is the same as the NetID.<br>";
					$sql = "insert into roster value('$idtest','$ids')";
					$result = mysql_query($sql) or die('Error: '.mysql_error());
					if(!$result) echo "Create account: $ids failed.<br>";
				}
			}
		}
	}
	else{
		echo "Request ID: $idtest cannot submit";
		// $log->info("Request ID: $idtest cannot insert into test. ");
	}
	
	mysql_close($con);//close db
}
?>