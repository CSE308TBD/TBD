    <?php
    $server="43.242.129.31";//server
    $db_username="gzzkxzc1_tbd";//username
    $db_password="2015cse308";//password
    $con = mysql_connect($server,$db_username,$db_password);//connect
    if(!$con){
        die("can't connect".mysql_error());//error
    }
    mysql_select_db('gzzkxzc1_tbd',$con);//select database
?>