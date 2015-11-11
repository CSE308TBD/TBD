<?php
	include('connect.php');
	$tid = $_GET['tid'];
	//delete from roster
	$sql = "delete from roster where ID_TEST='$tid'";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	// if($result==null){}//not found in roster, which means the tid represents a course request(it can be delete directly)
	
	//delete from test
	$sql = "delete from test where ID_TEST='$tid'";
	$result = mysql_query($sql) or die('Error: '.mysql_error());
	if($result)
	{
		echo $tid.' Deleted.';
	}
	
	mysql_close($con);//close db
?>
<br><a href='IHome.php'>Return to Home Page</a>