<?php
$proj_id = $_POST['proj_id'];
//proj_session_start();

$submit_value = $_POST['submit'];
$submit_permission=$_POST['perms'];

echo $submit_value;

//print_r($_POST);
//echo $_POST['permission'];

if($submit_permission == 'permission'){
		$proj_id = $_POST['proj_id'];
	$user_id = $_POST['user_id'];
	$permissions = $_POST['permission'];
	echo $proj_id;
	//Hämta info om permissions
	$sql_proj = mysql_query("SELECT * FROM project WHERE user_id='$user_id' AND project_id = '$proj_id'");
	$proj = mysql_fetch_assoc($sql_proj);
	
	if($user_id == $proj['admin_id']){
		echo "Cant change project main-admin!";
	}else{
		$sql_permissions = mysql_query("UPDATE members_project SET permissions = '$permissions' WHERE user_id = '$user_id' AND project_id = '$proj_id'");		
		

	}
}else{

if($submit_value == 'Accept'){
	$proj_id = $_POST['proj_id'];
	$user_id = $_SESSION['user_id'];

	//Lägg till användaren i members_project
	$sql_add = "INSERT INTO members_project (user_id, project_id) VALUES ($user_id, $proj_id)";
	//Ta bort inviten
	$sql_remove = "DELETE FROM invites WHERE user_id = '$user_id' AND project_id = '$proj_id'";
	//addera members_in_project i project
	$sql_update = "UPDATE project SET nr_members = nr_members + 1 WHERE id = '$proj_id'";
	
	mysql_query($sql_add);
	mysql_query($sql_remove);
	mysql_query($sql_update);
	/*
	error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);


flush();
header("Location: http://www.website.com/");
die('should have redirected by now');
*/

}elseif($submit_value == "Reject"){
	$proj_id = $_POST['proj_id'];
	$user_id = $_SESSION['user_id'];

	//Ta bort raden i invites

	$sql_remove = "DELETE FROM invites WHERE project_id = '$proj_id' AND user_id = '$user_id'";

	$result = mysql_query($sql_remove);

	if($result == true){

	}else{
		//echo "Not success";
	}



}elseif($submit_value == "X"){

	$proj_id = $_POST['proj_id'];
	$user_id = $_POST['user_id'];
	
	//Hämta info om projektet
	$sql_proj = mysql_query("SELECT * FROM project WHERE id='$proj_id'");
	$proj = mysql_fetch_assoc($sql_proj);

	//Ta bort raden i members_project

	if($user_id == $proj['admin_id']){
		echo "Cant remove admin!";
	}else{
		$sql_remove = "DELETE FROM members_project WHERE project_id = '$proj_id' AND user_id = '$user_id'";
		$result = mysql_query($sql_remove);	

	}

}elseif($submit_value == "permission"){
	$proj_id = $_POST['proj_id'];
	$user_id = $_POST['user_id'];
	$permissions = $_POST['permission'];
	echo $proj_id;
	//Hämta info om permissions
	$sql_proj = mysql_query("SELECT * FROM project WHERE user_id='$user_id' AND project_id = '$proj_id'");
	$proj = mysql_fetch_assoc($sql_proj);
	
	if($user_id == $proj['admin_id']){
		echo "Cant change project main-admin!";
	}else{
		$sql_permissions = mysql_query("UPDATE members_project SET permissions = '$permissions' WHERE user_id = '$user_id' AND project_id = '$proj_id'");		
		
	
	}
		
}else{
	
	$email = $_POST['email'];
	if(empty($email) || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
		echo '<p style="color:red;">Must enter an email in a valid format </p>';
	
	}else{
		$proj_id = $_POST['id'];
		$url = $_POST['url'];
	
		//Kontrollera så att emailen är rätt! SAKNAS
	
		$user_id = $_SESSION['user_id'];
	
		//echo "Personen du vill inv: " . $email;
	
		//echo "<br>";
	
		//echo "Projektets ID: " . $proj_id;
	
		//echo "<br>";
	
		//echo $url;
	
		//echo "<br>";
	
		//echo "Ditt egna ID: " . $user_id;
	
		//Hämtar all info om användaren och projektet
		$projQuery=mysql_query("SELECT * FROM `project` WHERE `id` = $proj_id");
		$userQuery=mysql_query("SELECT * FROM `user` WHERE `email` = '$email'");
	
		$proj = mysql_fetch_assoc($projQuery);
		$user = mysql_fetch_assoc($userQuery);
	
		$query_id = $user['id'];
		$query_proj = $proj['id'];
	
		//user_id är den inloggades ID,
		if($user_id === $proj['admin_id']){
			//Om det är admin som försöker göra något
			//if(empty(mysql_fetch_assoc(mysql_query("SELECT * FROM members_project WHERE 'user_id' = $user['id'] & 'proj_id' = $proj_id")))){
			//Om användaren INTE redan finns med i projektet
	
			//echo "<br>";
	
			//echo "Personen du vill inv ID: " . $query_id;
	
			//echo "<br>";
	
			//echo "Projektet ID: " . $query_proj;
	
			$sql_add = "INSERT INTO `invites` (user_id, project_id) VALUES ($query_id, $query_proj)";
	
			mysql_query($sql_add);
			//$con->query($sql_add) or die($con->error);
			
			echo '<p style="color:green">Invite sent</p>';
	
		
		}else{
			//echo "<br>";
			//echo "You are not admin over this project!";
			echo '<p style="color:red;">You have to be admin to invite other members.</p>';
	
		}
	}

}
}

//If fail location: $url . &invError=1

?>

<html>
    <head>
    <meta http-equiv="refresh" content="2;url=?page=showProject&id=<?php echo $proj_id; ?>">
      </head>
        <body>
        <div style="color: black;">
        If you are not redirected automatically, follow the <a href='?page=showProject&id=<?php echo $proj_id; ?>'>link to get back</a>
        </div>

    </body>
</html>



