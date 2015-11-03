<?php
//Log out page, destroy session.
session_start();
if(isset($_SESSION['userID'])){ 
    $_SESSION = array(); 
    if(isset($_COOKIE[session_name()])){ 
        setcookie(session_name(),'',time()-3600); 
    } 
    session_destroy(); 
} 
header('location:login.html');
session_destroy();
?>