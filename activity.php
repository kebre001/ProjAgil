<?php

	include('config.php');
	include('functions.php');
	
	$timenow = time();
	$user_id = '6';
	$proj_id = '1';
	
	$sql_user = mysql_fetch_assoc(mysql_query("SELECT username FROM user WHERE id = '$user_id' "));
	createActivity('User permission change', 'User: ' . $sql_user['username'] . 'has new permissions', $timenow, $proj_id);	
	
	//$result=mysql_query("SELECT project_id FROM `members_project` WHERE `user_id` = $user_id ");
	
	//if(createActivity('Hej', 'Lorem Ipsum OSV..MM', $timenow, '14') == TRUE){	echo "Success"; }else{ echo "Wong"; }
	
	/*$sql = "SELECT * FROM activity WHERE project_id = ";
	
	while($row1=mysql_fetch_assoc($result)){
	
		$sql = $sql . $row1['project_id'] . ' OR ';

	}
	$sql = substr($sql, 0, -3);
	$sql = $sql . 'ORDER BY time DESC LIMIT 20';
	
	$activities = mysql_query($sql);
		
	while($activity = mysql_fetch_assoc($activities)){
		echo 'Title: ' . $activity['title'] . ' , Conent: ' . $activity['content'] . ' , ' . date("Y-m-d:H:i:s",$activity['time']) . ' , Project ID: ' . $activity['project_id'];
		echo "\n";
	}*/
	
?>


