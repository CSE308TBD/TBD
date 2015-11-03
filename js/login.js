

$(document).ready(function() {
 
 $("#submitI").click(function() {
 
  var action = $("#loginI").attr('action');
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
   window.location="IHome.php";}
    else
    $("#alert").html("<p style='color:red'>Invalid username and/or password.</p>");  
   }
  });
  
  return false;
 });

 $("#submitS").click(function() {
 
  var action = $("#loginS").attr('action');
  var form_data = {
   name: $("#names").val(),
   password: $("#passwords").val(),
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
   window.location="SHome.php";}
    else
     $("#alert2").html("<p style='color:red'>Invalid username and/or password.</p>"); 
   }
  });
  
  return false;
 });
 
  $("#submitA").click(function() {
 
  var action = $("#loginA").attr('action');
  var form_data = {
   name: $("#namea").val(),
   password: $("#passworda").val(),
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
   window.location="Ahome.php";}
    else
     $("#alert2").html("<p style='color:red'>Invalid username and/or password.</p>"); 
   }
  });
  
  return false;
 });
 
 });

