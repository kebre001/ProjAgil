<?php
	$name='name1';
	$startDate='startDate1';
	$endDate='endDate1';
	$projDesc='projDesc1';
	
	if(empty($name)==true || empty($startDate)==true || empty($endDate)==true || empty($projDesc)==true){
		$errors[]='Error, all needs to be filled';
	}else{
	
		//if(!empty($errors){
			//echo output_errors($errors);
		//}else{
			$registerProject= array(
				'name'			=>	$name,
				'description'	=>	$projDesc,
				'start_date'	=>	strtotime($startDate),
				'end_date'		=>	strtotime($endDate),
				'nr_members'	=>	'1',
				'admin_id'		=>	'6',);
			
			createProject($registerProject);
			$projectId=mysql_fetch_assoc(mysql_query("SELECT id FROM project WHERE admin_id = '6' ORDER BY id DESC LIMIT 1"));
			$projID=$projectId['id'];
			mysql_query("INSERT INTO members_project (user_id, project_id, permissions) VALUES (6, $projID, '1')");
			
?>

<h1>Congratz, you have created a new project, you will be redirected to project settings site so you can manage you project</h1>
	
<?php
		header("refresh:5;url=?page=projsettings");
		//}
	}
?>