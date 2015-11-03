<h3>Please Enter A Student ID </h3>
<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	Student ID: <input type="text" name="StudentID" value=""/>
	<br />
	<br />
	<input type="submit" name="submit" value="Submit"/>
</form>

<?php
	include('core/init.inc.php');

	if(isset($_POST['submit'])) { 
		$q = "SELECT * FROM Roster WHERE ID_STUDENT = '$_POST[StudentID]'";
		$result = mysql_query($q) or die(mysql_error());
		echo "<table border=\"1\" style=\"width:100%>\"";
		echo "<tr> <th>Class ID</th> <th>Student ID</th> </tr>";
		while($info = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>".$info["ID_CLASS"]."</td>";
			echo "<td>".$info["ID_STUDENT"]."</td>";
			echo "</tr>";
		} 
	}
?>

