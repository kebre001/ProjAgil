<?php
$host = "localhost";
$user = "USERNAME";
$db = $user;
$pw = "1234567890";

$con=mysqli_connect($host,$user,$pw,$db);
// Check connection
if (mysqli_connect_errno()){
  	echo "Failed to connect to MySQLi: " . mysqli_connect_error();
  }
  
$mysql = mysql_connect($host,$user,$pw);
mysql_select_db($db, $mysql);

if(!$con)
{
        echo 'error sql connect';
}


?>
