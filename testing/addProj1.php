<?php
$x=1; 
while($x<=5) {
  //echo "The number is: $x <br>";
	include('config.php');
	include('functions.php');

	$name='name1';
	$startDate=time();
	$endDate=time();
	$projDesc='projDesc1';

	if(empty($name)==true || empty($startDate)==true || empty($endDate)==true || empty($projDesc)==true){
		$errors[]='Error, all needs to be filled';
	}else{
		
		echo date("Y-m-d",$startDate);
		//if(!empty($errors){
			//echo output_errors($errors);
		//}else{
			$registerProject= array(
				'name'			=>	$name,
				'description'	=>	$projDesc,
				'start_date'	=>	$startDate,
				'end_date'		=>	$endDate,
				'nr_members'	=>	'1',
				'admin_id'		=>	'6',);

			createProject($registerProject);
			$projectId=mysql_fetch_assoc(mysql_query("SELECT id FROM project WHERE admin_id = '6' ORDER BY id DESC LIMIT 1"));
			$projID=$projectId['id'];
			mysql_query("INSERT INTO members_project (user_id, project_id, permissions) VALUES (6, $projID, '1')");}
$x++;
} 
?>
