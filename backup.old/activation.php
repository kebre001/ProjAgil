<?php

include('config.php');
include('functions.php');

$code = $_GET['code'];

echo md5(time());

echo "<br>";

echo $code;

echo "<br>";

if(activateCode($code) == TRUE){
	echo "Activation successfully";
}else{
	echo "Failed";
}
activateCode($code);

echo "<br>";

if(checkActivation('1') == TRUE){
	echo "Activated";
}else{
	echo "Not activated!";
}
?>
<html>
	<form action="" method="get">
		<input type="text" name="code">
		<input type="submit">
	</form>
</html>