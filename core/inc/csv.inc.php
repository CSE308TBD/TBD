<?php

// reads a csv file, returning an array of rows
function uploadUsers($handle) {

	$row = 1;

	while(($fileop = fgetcsv($handle,1000,",")) !== false) {

		if($row > 1) {	

			$FirstName = $fileop[0];
			$LastName = $fileop[1];
			$NetID = $fileop[2];
			$Email = $fileop[3];

			if(strpos($LastName, '\'')) $LastName = mysql_real_escape_string($LastName);

			$sql = mysql_query( "INSERT INTO Users (UserID, Password, LastName, 
					FirstName,Email,Role) VALUES ('$NetID','111111','$LastName','$FirstName','$Email','Role')");
		}
		$row++;
	}

	echo "fuck yeah";
}

function uploadClasses($handle) {

	$row = 1;

	while(($fileop = fgetcsv($handle,1000,",")) !== false) {

		if($row > 1 && $fileop[0] !== "") {	

			$ClassID = $fileop[0];
			$Subject = $fileop[1];
			$CatalogNumber = $fileop[2];
			$Section = $fileop[3];
			$InstructorNetID = $fileop[4];
			if(strpos($InstructorNetID, '\'')) $InstructorNetID = mysql_real_escape_string($InstructorNetID);

			$sql = mysql_query( "INSERT INTO Course (ID_CLASS,Subject,CatalogNumber,
				Section,term,ID_INSTRUCTOR) VALUES ('$ClassID','$Subject','$CatalogNumber','$Section','Unknown','$InstructorNetID')");
		}
		$row++;
	}

	echo "fuck yeah the second time";
}

function uploadRosters($handle) {

	$row = 1;

	while(($fileop = fgetcsv($handle,1000,",")) !== false) {
		if($row > 1) {	

			$NetID = $fileop[0];
			$ClassID = $fileop[1];

			$sql = mysql_query( "INSERT INTO Roster (ID_CLASS, ID_STUDENT) VALUES ('$ClassID','$NetID')");

		}
		$row++;
	}

	echo "fuck yeah the third time";
}

?>