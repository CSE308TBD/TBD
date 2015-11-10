<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'cse308';

	$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
	mysql_select_db($db, $conn);
?>