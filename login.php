<?php

include 'config.php';
include 'functions.php';

proj_session_start(); // Our custom secure way of starting a php session. 

?>

<html>

<head>
	<title>ProjAgil</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
</head>
<body>

<div class="login">
	<div class="header_logo" style="margin-left: auto; margin-right: auto; text-align:center;">
		<img src="images/logo.png" width=100%></img>
	</div>
	<p style="text-align: center; color: red;"><?php if(isset($_GET['error'])) {
		echo getErrorMessage($_GET['error']);
		}?>
	</p>
	<div id="wrapper">
		<form action="process_login.php" class="login-form" method="post" name="login">
			<div class="header">
				<h1>Login Form</h1>
				<span>Fill out the form below to login to ProjAgil!</span>
			</div>
			<div class="content">
			<input type="text" class="input username" name="email" placeholder="Email/Username" />
			<div class="user-icon"></div>
			<input type="password" class="input password" name="password" id="password" placeholder="Password"/>
			<div class="pass-icon"></div>
			</div>
			
			<div class="footer">
			<input type="submit" name="submit" value="Login" class="button" />
			<input type="submit" name="submit" value="Register" class="register" />
			</div>
		</form>
	</div>
</div>
<div class="gradient"></div>

</body>

</html>

