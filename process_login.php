<?php

include('config.php');
include('functions.php');
proj_session_start(); // Our custom secure way of starting a php session.

$escapedEmail = mysql_real_escape_string($_POST['email']);
$escapedPW = mysql_real_escape_string($_POST['password']);
//$escapedUsername = mysql_real_escape_string($_POST['username']);

$query_check_credentials = "SELECT * FROM user WHERE email='$escapedEmail'";
$result_check_credentials = mysqli_query($con, $query_check_credentials);

$saltQuery = "SELECT password_salt FROM user WHERE email = '$escapedEmail';";
$result = mysql_query($saltQuery);
# you'll want some error handling in production code :)
# see http://php.net/manual/en/function.mysql-query.php Example #2 for the general error handling template

$row = mysql_fetch_assoc($result);
$salt = $row['password_salt'];

$saltedPW =  $escapedPW . $salt;

$hashedPW = hash('sha256', $saltedPW);

$user = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE email = '$escapedEmail' OR username = '$escapedEmail'"));

# if nonzero query return then successful login

if($_POST['submit'] == 'Register'){
	header("Location: register.php?email=$escapedEmail");
}else{
	if(checkActivation($user['id']) == TRUE){
		if(login($escapedEmail, $escapedPW, $con) == true) {
			// Login success
			proj_session_start();
			echo 'Success: You have been logged in!';
			header('Location: ./index.php?page=projects');
		} else {
			// Login failed
			header('Location: ./login.php?error=1');
		}
	}else{
		header('Location: ./login.php?error=443');
	}
}

?>