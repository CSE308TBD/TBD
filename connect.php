<?php
    $server="localhost";//server
    $db_username="root";//username
    $db_password="11111111";//password
    $con = mysql_connect($server,$db_username,$db_password);//connect
    if(!$con){
        die("can't connect".mysql_error());//error
    }
    mysql_select_db('gzzkxzc1_tbd',$con);//select database
?>