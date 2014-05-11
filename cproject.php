<?php
	$name=$_POST['name'];
	$startDate=$_POST['startDate'];
	$endDate=$_POST['endDate'];
	$projDesc=$_POST['projDesc'];
	
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
				'admin_id'		=>	$user_id,);
			
			createProject($registerProject);
			$projectId=mysql_fetch_assoc(mysql_query("SELECT id FROM project WHERE admin_id = '$user_id' ORDER BY id DESC LIMIT 1"));
			$projID=$projectId['id'];
			mysql_query("INSERT INTO members_project (user_id, project_id, permissions) VALUES ($user_id, $projID, '2')");
			
			echo '<p style="color:green">Project created</p>';
?>

	
<?php
		header("refresh:5;url=?page=projsettings");
		//}
	}
?>

<html>
    <head>
    <meta http-equiv="refresh" content="2;url=http://doom.tidaa.se/Demo/sources359/">
      </head>
        <body>
        <div style="color: black;">
        If you are not redirected automatically, follow the <a href='http://doom.tidaa.se/Demo/sources359/'>link to get back</a>
        </div>

    </body>
</html>