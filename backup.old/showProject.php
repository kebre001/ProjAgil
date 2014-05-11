<?php
	
	$sessionid = $_SESSION['user_id'];
	$result_current_user = mysql_query("SELECT * FROM `user` WHERE `id`= $sessionid");
	$current_user = mysql_fetch_assoc($result_current_user);

	$projId=$_GET['id'];
	if(checkProjectInv($projId, $_SESSION['user_id'])){
		$result = mysql_fetch_assoc(mysql_query("SELECT * FROM `project` WHERE `id`= '$projId'"));
		
		echo"<div class='project-header'>";
		echo "<h1>Name:" . " ". $result['name'] . "</h1> - end date ". date("Y-m-d",$result['end_date'])." ";
		echo"</div>";
		
		
		echo"<div class='project-body'>";
		echo "<h2>Description:</h2>" . " " . $result['description'];	
		echo"</div>";

?>

<p></p>


<html style="background-color:#e6e6e6">
	<head>
		<link href="css/showProject.css" rel="stylesheet" type="text/css" />
		
		<!--- YAHOO RICH TEXT EDITOR --->
			<!-- Skin CSS file -->
			<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css">
			<!-- Utility Dependencies -->
			<script src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
			<script src="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"></script>
			<!-- Needed for Menus, Buttons and Overlays used in the Toolbar -->
			<script src="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"></script>
			<!-- Source file for Rich Text Editor-->
			<script src="http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js"></script>
		<!--- /YAHOO RICH TEXT EDITOR -->
	</head>
	<body style="background-color:#e6e6e6">
	<!--- Users in project --->
	<small style="color:black">Medlemmar i projektet</small><br>
	<div class="project-users" style="background-color:#e6e6e6; height: 100% !important;">
	
	
	
	<table style="width:100%; height:100%;">
		<tr>
		    <th style="color:black">Name</th>
		    <th style="color:black">Email</th>
		    <?php if($user_id === $result['admin_id']){ 
		    	echo "<th style='color:black'>Remove</th>"; $admin = true; 
		    	echo "<th style='color:black'>Permissions</td>";	
		    }?>
		</tr>
		<?php
			$result = mysql_query("SELECT * FROM `members_project` WHERE `project_id`= '$projId'");
			
			while($row=mysql_fetch_assoc($result)){ 
			$user_id = $row['user_id'];
			$permissions = $row['permissions'];
			$result_user = mysql_query("SELECT * FROM `user` WHERE `id`= '$user_id'");
			//$result_permissions = mysql_query("SELECT * FROM members_project WHERE `id`= '$user_id' AND project_id = '$projId'");
			$user = mysql_fetch_assoc($result_user);
			//$permissions = mysql_fetch_assoc($result_permissions);
			?>
				 <tr>
				    <td style="color:black"><?php echo $user['firstname'] . ", " . $user['lastname']; ?></td>
				    <!---<td><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>--->
				    <td><a href="mailto:<?php echo $user['email']; ?>"><img src="http://oregoncomp.com/wp-content/uploads/2010/11/envelope-icon.jpg"></a></td>
				    <?php if($admin){ ?>
				    <!---<td style="text-align:center;"><a href="remove_user.php?id=<?php echo $user['id']; ?>" style="color:red;">X</a></td> --->			
				    <td style="text-align:center;">
				    <form action="?page=process_invite" method="POST">
				    	<input type="text" value="<?php echo $projId ?>" name="proj_id" hidden="TRUE">
				    	<input type="text" value="<?php echo $user['id'] ?>" name="user_id" hidden="TRUE">
				    	<input type="submit" name="submit" value="X" style="color:#FF0000">
				    </form>
				    </td>
				    <td style="text-align:center;">
				    	<form action="?page=process_invite" method="POST">
				    		<select name="permission" onChange="submit();">
				    			<?php if($permissions == "1"){ ?>
					    			<option value="1" selected="TRUE">Admin</option>
					    			<option value="0">Normal</option>
				    			<?php }else{ ?>
				    				<option value="1">Admin</option>
					    			<option value="0" selected="TRUE">Normal</option>
					    		<?php } ?>
				    		</select>
					    	<input type="text" value="<?php echo $projId; ?>" name="proj_id" hidden="TRUE">
							<input type="text" value="<?php echo $user['id']; ?>" name="user_id" hidden="TRUE">
							<input type="text" name="perms" value="permission" hidden="TRUE">
							<!---
								ERROR FIXA DETTA, lyckas en posta med denna "variabel"
								
							--->
							
				    	</form>
				    </td>
				    <?php } ?>
				 </tr>
			
		<?php }	?>
		</table>
	</div>
	<!--- slut users --->
	
	<!--- KNAPPAR --->
	<a id="scrumb" class="btn" href="javascript: void(0)" ng-click="showScrumboard()" >Scrumboard</a>
	
	<a href="?page=scrumboard&id=<?php echo md5($projId . $result['name']); ?>" target="_blank"><img src="images/open_in_new_window.png" width="30px" height="30px"></a>

	
	<a id="invite" class="btn" href="javascript: void(0)" ng-click="showInvite()" >+Invite User</a>
	<?php if(isset($_GET['invError'])){ echo getErrorMessage($_GET['invError']); } ?>

	
	<a id="chat" class="btn" href="javascript: void(0)" ng-click="showChat()" >Join Chat</a>
	<a href="irc.php?&username=<?php echo $current_user['username']; ?>&channel=<?php echo md5($projId . $result['name']); ?>" target="_blank"><img src="images/open_in_new_window.png" width="30px" height="30px"></a>
	
	<a id="createDic" class="btn" href="javascript: void(0)" ng-click="showCreateDoc()" >Documents</a>
	
	<a id="editDesc" class="btn" href="javascript: void(0)" ng-click="showEdit()" >Edit Project</a>
	
	<!--- SLUT KNAPPAR --->
	
	<!--- ALLA SLIDE DOWNS --->
	<!--- Edit Desc --->
	<div class="paddRow edit" >
        	<div class="wrap_edit">
			  <?php $project = mysql_fetch_assoc(mysql_query("SELECT * FROM project WHERE id= '$projId'")); ?>
	        	<form action="?page=edesc" method="POST">
					<div id="col_1" class="yui-skin-sam" style="width: 39%; float:left; padding-left:5px;">
						<textarea rows="10"  style="width:95%;" name="description" id="msgpost">
							<?php echo $project['description']; ?>
						</textarea>
						<script>
                        	var myEditor = new YAHOO.widget.SimpleEditor('msgpost', {
								height: '300px',
								width: '95%',
								dompath: true, //Turns on the bar at the bottom
								animate: true, //Animates the opening, closing and moving of Editor windows
								handleSubmit: true
                        });
                        myEditor.render();
						</script>
					</div>
					<div id="col_2" style="width: 30%; float:left;">
							<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="date1" value="<?php echo date("Y-m-d", $project['start_date']) ?>"><br>
							<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="date2" value="<?php echo date("Y-m-d", $project['end_date']) ?>"><br>
					</div>
					<div id="col_3" style="width: 30%; float:left">
							
					</div>
					<input type="text" hidden="TRUE" value="<?php echo $projId?>" name="proj_id">					
					<input type="submit" value="Submit">
	        	</form>
			</div>
		</div>
	<!--- /Edit Desc --->
		<!--- chat --->
	    <div class="paddRow chat" >
        	<div class="wrap_chat">
				<small style="color:red" style="background-color:black !important">Om du är ansluten till chatten kommer du bli ombedd om bekräftelse när du lämnar hemsidan (gäller även vid uppdatering)
				<iframe src="http://irc.doom.tidaa.se:7778/?nick=<?php echo $current_user['username'] ?>#<?php echo md5($projId . $result['name']); ?>" style="width: 100%; height:100%; border: none;"></iframe>   
			      

			</div>
		</div>
		<!--- /chat --->
			<!-- Invite slidedown -->
    <div class="paddRow invite" >
        <div class="wrap_invite">
            <img class="close" src="images/close.png" ng-click="closeInvite()" />
            
			<form action="?page=process_invite" method="POST">
				<input type="text" name="url" hidden="true" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></input>
				<input type="text" name="id" hidden="true" value="<?php echo $projId;?>"></input>
				<input type="text" name="email" placeholder="Email" style="font-size:16px; font-family:Tahoma;"></input>
				<button>Invite</button>
			</form>
			<small style="color:red">Only admins can invite users to this project.</small>
        </div>
    </div>
	<!--- slut invite --->
	
	<!--- createdocument --->
	<div class="paddRow createDoc" >
        <div class="wrap_createDoc">
            <img class="close" src="images/close.png" ng-click="closeCreateDoc()" />
            
            
				<div style="color: black; text-align:left; padding-top: 10px; font-size: 1.5em; width: 45%; float:right;">
					<!--- Lista alla dokument --->
					<table>
						<tr>
							<th>Documents</th>
						</tr>
					<?php
					$result = mysql_query("SELECT * FROM `document` WHERE `project_id`= '$projId'");
					while($row=mysql_fetch_assoc($result)){ ?>
						<tr>
							<td><a href="?page=document&id=<?php echo $row['docMd5']; ?>" target="_BLANK"><?php echo $row['name']; ?></a></td>
							<td style="text-align:center;">
						    <form action="?page=createDoc" method="POST">
						    	<input type="text" value="<?php echo $projId; ?>" name="proj_id" hidden="TRUE">
						    	<input type="text" value="<?php echo $sessionid; ?>" name="user_id" hidden="TRUE">
						    	<input type="text" value="<?php echo $row['id']; ?>" name="doc_id" hidden="TRUE">
						    	<input type="submit" name="submit" value="X" style="color:#FF0000">
						    </form>
						    </td>
						</tr>
					<?php } ?>
					</table>
					<!--- /Lista alla dokument -->
				</div>
				<div style="float: left; width=45%;">
					<form action="?page=createDoc" method="POST">
						Document name: <input type="text" name="docName">
						<?php echo $projId; ?>
						<input type="text" value="<?php echo $projId; ?>" hidden="TRUE" name="proj_id">
						<input type="submit" name="submit" value="Create">
					</form>
					<!-- <small style="color:red">Use unique names for your files</small> --->
				</div>


        </div>
    </div>
	<!--- slut createdocument --->
		 <!-- scrum slidedown -->
    <div class="paddRow scrumboard" >
        <div class="wrap_scrum">
            <img class="close" src="images/close.png" ng-click="closeScrumboard()" />
            
			<div class="scrum_frame" seamless="seamless" scrolling="no" style="width: 100%; height: 670px; overflow:hidden;">
					<?php //MD5 kryptering av projektets id och projektets namn. T.ex ID: 17 Name: Test blir 17Test och sedan MD5 på det ?>
		
				<iframe src="http://doom.tidaa.se:1338/<?php echo md5($projId . $result['name']); ?>" style="width: 100%; height:100%; border: none;"></iframe>
			</div>
        </div>
    </div>
	<!--- SLUT PÅ ALLA SLIDE DOWNS --->
	</body>
</html>
<?php
}else{
		echo 'You have no permission for this project';
	}
?>