<?php
	include('core/init.inc.php');

	if(isset($_POST['submit'])){

		$file = $_FILES['file']['tmp_name'];

		if($file === "") {
			header('Location: test.php');
			break;
		}

		$handle = fopen($file,"r");

		$fileName = substr($_FILES['file']['name'],0,strpos($_FILES['file']['name'],"."));

		switch ($fileName) {
			case "user": uploadUsers($handle); break;
			case "roster": uploadRosters($handle); break;
			case "class": uploadClasses($handle); break;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<meta charset="utf-8">
			<title>Upload</title>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" ></script>
	</head>
	<body>
		<div>
			<form method="post" action="test.php" enctype="multipart/form-data">
				<link rel="stylesheet" type="text/css" href="style/stylesheet.css" />
				<input type="file" name="file" />
				<br />
				<br />
				<input type="submit" class="myButton" name="submit" value="Submit" />
			</form>
		</div>
	</body>
</html>