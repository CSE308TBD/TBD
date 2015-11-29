<?php
    $server="localhost";//server
    $db_username="root";//username
    $db_password="will0925.";//password
    $con = mysql_connect($server,$db_username,$db_password);//connect
    if(!$con){
        die("can't connect".mysql_error());//error
    }
    mysql_select_db('test',$con);//select database
?>