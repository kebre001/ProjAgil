<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'database/connection.php';
include 'functions/functions.php';
include 'functions/general.php';


if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'id', 'username', 'password');
	/*if(user_active($user_data['username']) === false){ //banna någon
		session_destroy();
		header('Location: index.php');
		exit();
	}*/
}

$errors = array();

?>