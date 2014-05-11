<?php

	//Kolla så användaren har rättigheter att skapa till rätt projekt
	// Document must contain at least one character //
	$submit_vaule = $_POST['submit'];
	
	$proj_id = $_POST['proj_id'];

	if($submit_vaule=='Create'){
		if(empty($_POST['docName'])){
			echo '<p style="color:red;">Document must contain at least one character</p>';
		}else{
			$name = $_POST['docName'];
		//$proj_id = $_POST['proj_id'];
		
		$doc_md5 = md5($proj_id . $name . time());
		
		$date = time();
	
		$sql = "INSERT INTO document (project_id, docMd5, name, date) VALUES ('$proj_id', '$doc_md5', '$name', '$date')";
		
		$result = mysql_query($sql);
		
		if($result == TRUE){
			echo $doc_md5;
			echo "<br>";
			echo '<p style="color:green">Success</p>';
		}else{
			echo "<br>";
			echo '<p style="color:red;">Not working</p>';
		}
	}
		}
		else if($submit_vaule=='X'){
		//För att ta bort dokument
		$user_id=$_POST['user_id'];
		$proj_id=$_POST['proj_id'];
		$doc_id=$_POST['doc_id'];
		
		$sqlAdminQuery=mysql_query("SELECT * FROM `members_project` WHERE `project_id` = $proj_id");
		while($sqlAdmin=mysql_fetch_assoc($sqlAdminQuery)){
			$permission=$sqlAdmin['permissions'];
		
			if($user_id===$sqlAdmin['user_id'] && $permission==='2'  || $user_id===$sqlAdmin['user_id'] && $permission==='1'){
				mysql_query("DELETE FROM `document` WHERE `id` = $doc_id");
			}
		}
	}


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