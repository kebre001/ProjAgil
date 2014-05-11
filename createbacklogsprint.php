<?php
	include 'config.php';
	include 'functions.php';

	$title=$_POST['title'];
	$estday=$_POST['estday'];
	$projid=$_POST['proj_id'];
	$userid=$_POST['user_id'];
	$type=$_POST['type'];

	
	$querybacklogsprintperm=mysql_query("SELECT * FROM `members_project` WHERE `project_id` = '$projid' AND `user_id` = '$userid'");
	
	
	if($querybacklogsprintperm==TRUE){
		if($type==="backlog"){
			mysql_query("INSERT INTO backlog (title, status, estdate, project_id) VALUES ('$title', '0', '$estday', '$projid')");
			echo "Backlog created!";
		}else{
			mysql_query("INSERT INTO sprint (title, estdate, project_id) VALUES ('$title', '$estday', '$projid')");
			echo "Sprint created!";
		}
	}else{
		echo 'Error, could create ' . $type;
	}
	
?>