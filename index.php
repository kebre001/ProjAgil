<?php
include 'config.php';
include 'functions.php';
proj_session_start();

$user_id=$_SESSION['user_id'];
	if(login_check($con)){
		include_once 'includes/header.php';
		if(isset($_GET['page']) && isValidPage($_GET['page']) && !empty($_GET['page'])){
			@include($_GET['page'] . '.php');
		} else {
			//header('Location: index.php?page=projects');
			//echo "heeeej";
			@include('projects.php');
			//@include('index.php?page=privacy');
		}
		include_once 'includes/footer.php';
	}else{
		header('Location: login.php');
	}
?>
