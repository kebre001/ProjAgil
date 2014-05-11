<?php
$connect_error = 'Sorry some temporary issues have come a cross, we are on it!';
mysql_connect('localhost', 'projekt', 'hS35LeJuNABRUBP9') or die($connect_error);
mysql_select_db('projekt') or die($connect_error);
?>
