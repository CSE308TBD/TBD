<?PHP    
    $is_ajax = $_REQUEST['is_ajax'];
 if(isset($is_ajax) && $is_ajax)
 {

    include('connect.php');//connect database
    $name = $_REQUEST['name'];//post the login name
    $passowrd = md5($_REQUEST['password']);//post the password
	
	$sql = "select * from Users where UserId = '$name' AND Password='$passowrd' AND Role = 'Administrator'";//check login
    $result = mysql_query($sql);//sql
    $rows=mysql_num_rows($result);//return 
	
    if ($name && $passowrd){//if both field are not empty
             if($rows){//0 false 1 true
			 		session_start();
			 		$row = mysql_fetch_assoc($result);
					$userID = $row['UserId'];
			 		$firstName = $row['FirstName'];
					$lastName = $row['LastName'];
					$Role = $row['Role'];
					$_SESSION['userID'] = $userID;
					$_SESSION['firstName'] = $firstName;
					$_SESSION['lastName'] = $lastName;
					$_SESSION['Role'] = $Role;
					session_register("userID"); 
					session_register("Role");
					echo "success";
             }else{
              echo "false";
             }             
    }else{//if empty
                echo "Password and Username Can't be empty";
                echo "
                      <script>
                            setTimeout(function(){window.location.href='login.html';},1000);
                      </script>";                  
    }
    mysql_close();//
 }
?>