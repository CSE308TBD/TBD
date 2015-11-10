<?php
	include('core/init.inc.php');

	if(!isset($_POST['submit'])) {
		$id = $_GET['id'];
		$term = substr($id,0,strrpos($id,"*"));
		$columnName = substr($id,strrpos($id,"*")+1);
		$temp = explode(":",$columnName,2);
	}
?>

<h3> You are modifying <?php echo $temp[0]?> </h3>
<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<?php echo $temp[0].": " ?><input type="text" name="updatedValue" value="<?php echo $temp[1];?>" />
	<br />
	<br />
	<input type="submit" name="submit" value="Modify"/>
	<input type="hidden" name="term" value="<?php echo $term;?>"/>
	<input type="hidden" name="column" value="<?php echo $temp[0];?>"/>
</form>

<?php
	if(isset($_POST['submit'])) { 
		$update = "UPDATE TestCenterInfo SET ".$_POST['column']." = '$_POST[updatedValue]' WHERE Term = '".$_POST['term']."'";
		mysql_query($update) or die(mysql_error());
		header("Location: editCenterInfo.php");
	}
?>