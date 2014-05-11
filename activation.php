<?php

include('config.php');
include('functions.php');

if(isset($_GET['code'])){
	$code = mysql_real_escape_string($_GET['code']);
}else{
	$code = "H4X0R Code";
}

$code_click = mysql_real_escape_string($_POST['code_click']);
if(activateCode($code_click) == TRUE){
	$message = 'Activated! =)';
}else{
	$message = 'Not activated or already activated';
}

?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/activation.css">
	</head>
	<body>
		<div id="login" style="padding-top: 12.5%; padding-bottom: 12.5%;">
		  <h1>Activate your account</h1>
		  <form action="activation.php" method="POST">
		    <input type="text"  name="code_click" value="<?php echo $code ?>" />
		    <input type="submit" value="Activate" />
		  </form>
		  <?php if(!empty($_POST)){ echo '<h1>' . $message . '</h1>';} ?>
		  <?php if(!empty($message_2)){ echo '<h1>' . $message_2 . '</h1>';} ?>
		</div>
	</body>
</html>