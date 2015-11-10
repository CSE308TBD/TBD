<?php
	include('core/init.inc.php');

	$query = "SELECT * FROM TestCenterInfo";

	$result = mysql_query($query);

	while($info = mysql_fetch_array($result)) {
		echo "<h3>".$info["Term"]."</h3>";
		echo "<p> Gap Time: ".$info["GapTime"]."</p>";
		echo "<a href=\"modify.php?id=".$info["Term"]."*GapTime:".$info["GapTime"]."\">Modify</a>";
		echo "<p> Reminder Time: ".$info["ReminderTime"]."</p>";
		echo "<a href=\"modify.php?id=".$info["Term"]."*ReminderTime:".$info["ReminderTime"]."\">Modify</a>";		
		echo "<p> Start Date: ".$info["StartDate"]."</p>";
		echo "<a href=\"modify.php?id=".$info["Term"]."*StartDate:".$info["StartDate"]."\">Modify</a>";		
		echo "<p> Available Seats in total: ".$info["NoOfSeats"]."</p>";
		echo "<a href=\"modify.php?id=".$info["Term"]."*NoOfSeats:".$info["NoOfSeats"]."\">Modify</a>";		
		echo "<p> Opening Time: ".$info["Opening"]."</p>";
		echo "<a href=\"modify.php?id=".$info["Term"]."*Opening:".$info["Opening"]."\">Modify</a>";		
	}
?>