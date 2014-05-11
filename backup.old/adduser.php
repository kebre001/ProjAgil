<?php
	
	$invPerson=$_POST['invperson'];
	$projQuery=mysql_query("SELECT * FROM `project` WHERE `admin_id` = $user_id");
	if(!empty($_POST['invperson'])){
		$result=mysql_fetch_assoc(mysql_query("SELECT `id` FROM `users` WHERE `email` = $invPerson"));
		
	}
	
	
?>
	<h2>Type in the mail or username of the person you want to invite to your project</h2>
	
	
	<form action="" method="POST">
	Project: 
	<select name="id">
					<?php while($row=mysql_fetch_assoc($projQuery)){?>
	                    <li>
		                    <option value="<?php echo md5($row['id']); ?>">
			                    <?php echo $row['name'];?>
			                </option>
			            </li>
			        <?php } ?>
				</select><br>
		<span>Email/Username: </span>
		<input type="text" name="invperson"><br>
		<input type="submit" name="addEmail">
	</form>


<?php
	include 'includes/footer.php';
?>