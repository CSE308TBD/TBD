<?php
	include('connect.php');
	$tid = $_GET['tid'];
	//delete roster
	$sql = "delete from roster where ID_TEST='$tid'";
	$result = mysql_query($sql);
	if($result){
		$sql = "delete from test where ID_TEST='$tid'";
		$result = mysql_query($sql);
		if($result)
		{
			echo $tid.' Deleted.';
		}
		else
		{
			echo $tid.' Fail to Delete from db test.';
		}
	}
	else
	{
		echo $tid.' Fail to Delete from db roster';
	}
	
?>
<br><a href='IHome.php'>Return to Home Page</a>