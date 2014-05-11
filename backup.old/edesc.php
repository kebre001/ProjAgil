<?php

	print_r($_POST);

	$description = mysql_real_escape_string($_POST['description']);
	$start_date = strtotime($_POST['startDate']);
	$end_date = strtotime($_POST['endDate']);
	$proj_id = $_POST['proj_id'];

	if(checkProjectInv($proj_id, $_SESSION['user_id'])){ 
		$sql = "UPDATE project SET description = '$description', start_date = '$start_date', end_date = '$end_date' WHERE id = '$proj_id'";
		if($result = mysql_query($sql)){
			//header("Location: ?page=projects&id=" . $proj_id);
			echo "success";
			echo '<a href="?page=showProjec&id=' . $proj_id . '">Link back</a>';
		}else{
			echo "Weirdo";
		}
	}else{
		echo "No permissions @$#&!";
	}
?>