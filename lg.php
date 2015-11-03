<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Login with jQuery AJAX</title>
<style>
body, input {
 font-family: Georgia, "Times New Roman", Times, serif;
}
#content {
 background-color: #eee;
 width: 300px;
 margin: 0 auto;
 border: 1px solid #aaa;
 -moz-border-radius: 10px;
 -moz-box-shadow: 0 0 10px #aaa;
 -webkit-border-radius: 10px;
 -webkit-box-shadow: 0 0 10px #aaa;
 padding: 10px;
}
#form1 label {
 display: block;
 font-size: 16px;
 line-height: 25px;
}
#form1 input[type=text], #form1 input[type=password] {
 padding: 2px;
 font-size: 16px;
 line-height: 20px;
 width: 250px;
}
#form1 input[type=submit] {
 font-size: 20px;
 font-weight: bold;
 padding: 5px;
}
.success {
 color: #060;
}
.error {
 color: red;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
 $("#login").click(function() {
 
  var action = $("#form1").attr('action');
  var form_data = {
   name: $("#name").val(),
   password: $("#password").val(),
   is_ajax: 1
  };
  
  $.ajax({
   type: "POST",
   url: action,
   data: form_data,
   success: function(response)
   {
    if(response == 'success')
	{
   window.location="Ihome.php";}
    else
     $("#message").html("<p class='error'>Invalid username and/or password.</p>"); 
   }
  });
  
  return false;
 });
 
});
</script>
</head>
<body>
<p>&nbsp;</p>
<div id="content">
  <h1>Login Form</h1>
  <form id="form1" name="form1" action="login1.php" method="post">
    <p>
      <label for="username">Username: </label>
      <input type="text" name="name" id="name" />
    </p>
    <p>
      <label for="password">Password: </label>
      <input type="password" name="password" id="password" />
    </p>
    <p>
      <input type="submit" id="login" name="login" />
    </p>
  </form>
    <div id="message"></div>
</div>
</body>
</html>