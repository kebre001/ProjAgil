<?php
	$description = mysql_real_escape_string($_POST['description']);
	$start_date = strtotime($_POST['startDate']);
	$end_date = strtotime($_POST['endDate']);
	$proj_id = $_POST['proj_id'];

	if(checkProjectInv($proj_id, $_SESSION['user_id'])){ 
		$sql = "UPDATE project SET description = '$description', start_date = '$start_date', end_date = '$end_date' WHERE id = '$proj_id'";
		if($result = mysql_query($sql)){
			//header("Location: ?page=projects&id=" . $proj_id);
			//echo "success";
			echo '<p style="color:green">Changes sumbitted</p>';
			//echo '<a href="?page=showProjec&id=' . $proj_id . '">Link back</a>';
		}else{
			echo "No success";
		}
	}else{
		echo "No permissions, you can buy your permissions at your local store";
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
