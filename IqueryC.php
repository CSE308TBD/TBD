<?PHP
    session_start();
#	$is_ajax = $_REQUEST['is_ajax'];
#	if(isset($is_ajax) && $is_ajax)
{
    include('connect.php');//connect database
    $idC = $_REQUEST['idC'];
	$sectionC = $_REQUEST['sectionC'];
	$termC = $_REQUEST['termC'];
	$sub = $idC[0].$idC[1].$idC[2];
	$catNo = $idC[3].$idC[4].$idC[5];
	$sql = "select * from course where Subject='$sub' AND CatalogNumber='$catNo' AND Section='$sectionC' AND Term='$termC'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$idclass=$row['ID_CLASS'];
	
	$sql = "select * from test where ID_CLASS='$idclass'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$num=$num+1;//_ex$num for ID_TEST
	
	$idtest = $idC.'-'.$sectionC.'_'.$termC.'_ex'.$num;
	
	$startDTL = strtotime($_REQUEST['startDTC']);
	$startDT = date("Y-m-d H:i:s",$startDTL);
	$endDTL = strtotime($_REQUEST['endDTC']);
	$endDT = date("Y-m-d H:i:s",$endDTL);
	
	$duration = $_REQUEST['durationC'];
	$idins = $_SESSION['userID'];

	$sql = "insert into test value('$idtest','$startDT','$endDT','$duration',null,'$idins','$idclass')";
	$result = mysql_query($sql);
	if($result)
	{
		echo "Request ID: $idtest is submitted. Please wait for approval.\r\n";
		echo "<a href=IHome.php>Home Page</a>";
		
		// $sql = "select * from ";
		// $sql = "insert into roster value('$idtest','$ids')";
		// $result = mysql_query($sql);
		
	}
	else{
		echo "Request ID: $idtest cannot submit";
	}
}
?>