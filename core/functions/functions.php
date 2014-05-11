<?php

function login($username, $password){
	$user_id = user_id_username($username);
	
	$username = sanitize($username);
	$password = md5($password);
	
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $user_id : false;
}


function user_exists($username) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function user_id_username($username){
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT `id` FROM `users` WHERE `username` = '$username'"), 0, 'id'));
}


function output_errors($errors){
	return '<ul><li style="color:red">' . implode('</li><li>', $errors) . '</li></ul>';
}

function registeruser($registerdata) {
	array_walk($registerdata, 'array_sanitize');
	$registerdata['password'] = md5($registerdata['password']);
	
	$fields = '`' . implode('`, `', array_keys($registerdata)) . '`';
	$data ='\'' . implode('\', \'', $registerdata) . '\'';
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
}

function createProject($projectData){
	array_walk($projectData, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($projectData)) . '`';
	$data ='\'' . implode('\', \'', $projectData) . '\'';
	
	mysql_query("INSERT INTO `project` ($fields) VALUES ($data)");
}

function user_data($user_id){ //log in uppgifter
	$data = array(); // Den f�r alla uppgifter genom en array som man kan anv�nda
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args(); //hur m�nga uppgifter du letar efter
	$func_get_args = func_get_args(); //Alla de uppgifter h�mtar man upp
	
	if($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' .  implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `id` = $user_id"));
		return $data;
		
	}
} 

function logged_in(){ //inloggad
	return (isset($_SESSION['user_id'])) ? true : false;
}

function loggedInProtect() { // om du inloggad, du kan inte komma till reg sidan
	if(logged_in() === true){
		header('Location: welcome.php');
		exit;
	}
}

function protectPage() { // om du inte �r inloggad kommer du inte in p� vissa hemsidor
	if(logged_in() === false){
		header('Location: protected.php');
		exit;
	}
}


?>