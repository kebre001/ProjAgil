<?php

//proj_sesstion_start();

?>
<!DOCTYPE html>
<html lang="en" ng-app="example359" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Script Tutorials" />
    <title>ProjAgil</title>
    <meta name="description" content="Responsive website using AngularJS - demo page">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <!-- add styles -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine"
	<!-- Demo Styles -->
	<!-- <link href="demo.css" rel="stylesheet"> -->

	<!-- Modal Styles -->
	<link href="css/modal.css" rel="stylesheet">
	
	<link href="css/table.css" rel="stylesheet">



    <!-- add javascripts -->
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/cheet.js/cheet.js"></script>
    
    
 
</head>
<body>
    <header>
        <div class="wrap">
            <!-- logo -->
            <a href="index.php?page=projects"><img class="logo" src="images/logo.v5.png"  ng-click="hideDrops()"/></a>

            <!-- navigation menu -->
            <nav>
                <ul>
                   <li><a id="workBtn" href="index.php?page=projects" ng-click="hideDrops()" ng-class="{activeSmall:part == 'projects'}" >My Projects</a></li>
                     <li><a id="newBtn" class="active" href="javascript: void(0)" ng-click="showAddProj()">+Proj</a></li>
                    <!--<li><a id="aboutBtn" href="#!/about" ng-class="{activeSmall:part == 'about'}">About</a></li>-->
                    <li><a id="contactBtn" class="active" href="javascript: void(0)" ng-click="showForm()">News Feed</a></li>
                    <li style="margin-right:0px"><a id="logoutBtn" class="active" href="javascript: void(0)" ng-click="showLogout()">Profile<?php if(checkInbox($_SESSION['user_id']) == TRUE){echo '(!)'; } ?></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- News Feed form -->
    <div class="paddRow contactRow">
        <div class="wrap">
            <div class="head">Latest Events</div>
            <img class="close" src="images/close.png" ng-click="closeForm()" />
            
			<?php
			$user_id_q = $_SESSION['user_id'];
			$result=mysql_query("SELECT project_id FROM `members_project` WHERE `user_id` = $user_id_q ");
			
			$sql = "SELECT * FROM activity WHERE project_id = ";
			
			while($row1=mysql_fetch_assoc($result)){
	
				$sql = $sql . $row1['project_id'] . ' OR ';
				//Appendar till strängen så att den hämtar alla aktiviteter som är aktiva för användaren
			}
			$sql = substr($sql, 0, -3);
			$sql = $sql . 'ORDER BY time DESC LIMIT 20';
			
			$activities = mysql_query($sql);
			
			?>

			<div class="newsfeed"> 
			<?php 
			while($activity = mysql_fetch_assoc($activities)){
				//echo 'Title: ' . $activity['title'] . ' , Conent: ' . $activity['content'] . ' , ' . date("Y-m-d:H:i:s",$activity['time']) . ' , Project ID: ' . $activity['project_id'];
			?>
				<div class="feedx">
					<!--- Message --->
					<div class="feedx_header" style="font-size:2em;"><a href="?page=showProject&id=<?php echo $activity['project_id']; ?>"><?php echo $activity['title']; ?></a></div>
					<br>
					<div class="feedx_content" style="margin-left:2.5em;"><?php echo $activity['content']; ?></div>
					
					<!--- More --->
					<div style="text-align:right;">
						<small><?php echo time_elapsed_string($activity['time']); ?></small>
					</div>
				</div>
			<?php } ?>	
			</div>
			
            <!-- contact us form response messages -->
            <div ng-show="process" style="text-align:center">
                <img class="loader" src="images/loader.png" />
            </div>
            <div ng-show="success"><p>Your message has been sent, thank you.</p></div>
        </div>
    </div>
    
    
    <!-- new Proj form -->
    <div class="paddRow newprojRow">
        <div class="wrap">
            <div class="head">New Project</div>
            <img class="close" src="images/close.png" ng-click="closeAddProj()" />
            
            <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            
            <script>
			  $(function() {
				var pickerOpts={dateFormat: "yy-mm-dd"};
				$( ".datepicker" ).datepicker(pickerOpts);
			  });
			  </script>
			  
			  <script>
			   $(document).ready(function () {

        $("#date1").datepicker({
            dateFormat: "yy-mm-dd",
           minDate: -20,
            onSelect: function (date) {
                var dt2 = $('#date2');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                //sets dt2 maxDate to the last day of 30 days window
                //dt2.datepicker('option', 'maxDate', startDate);
                dt2.datepicker('option', 'minDate', minDate);
                $(this).datepicker('option', 'minDate', minDate);
            }
        });
        $('#date2').datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
			  </script>
            
            <form action="?page=cproject" method="POST">
				<span style="font-size:1.5em">Name:</span><br><input type="text" name="name"><br>
				<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="date1"><br>
				<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="date2"><br>
				<span style="font-size:1.5em">Description: </span><br><textarea name="projDesc" rows="4" cols="50"></textarea><br>
			
				<input class="btn" type="submit" value="Create"/>
			</form>
            </div>
    </div>        
            
            <!-- Logout -->
            <div class="paddRow logoutRow">
        <div class="wrap">
            <div class="head" style="text-align:center">Profile</div>

            <img class="close" src="images/close.png" ng-click="closeLogout()" />
            
          <?php $result=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id`= '$user_id'")); ?>

            <p style="text-align:center"><?php echo $result['firstname'] . " " . $result['lastname']; ?></p>
            
            <!--- Invites listas här --->
            <?php
            	if(checkInbox($user_id) == TRUE){
            ?>
            <table align="center">
            	<thead>
	            	<tr>
						<th scope="col" id="proj_name" style="text-align:left;">Invites</th>
						<th scope="col" id="proj_id" colspan="2"> Actions</th>
					</tr>
            	</thead>
            <?php
			$result = mysql_query("SELECT * FROM `invites` WHERE `user_id`= '$user_id'");
			
			while($row=mysql_fetch_assoc($result)){ 
			$user_id = $row['user_id'];
			$proj_id = $row['project_id'];
			$result_proj = mysql_query("SELECT * FROM `project` WHERE `id`= '$proj_id'");
			$proj = mysql_fetch_assoc($result_proj);
			?>
				 <tr>
				    <td><?php echo $proj['name'] . ", " . $proj['id']; ?></td>
				    <td style="color:green;">
				    	<form action="?page=process_invite" method="POST">
					    	<input type="hidden" name="proj_id" value="<?php echo $proj['id'] ?>">
					    	<input type="submit" name="submit" value="Accept" style="color:green;">
				    	</form>
				    </td>
				    <td style="color:red;">
					    <form action="?page=process_invite" method="POST">
					    	<input type="hidden" name="proj_id" value="<?php echo $proj['id'] ?>">
					    	<input type="submit" name="submit" value="Reject" style="color:red;">
				    	</form>
				    </td>
				 </tr>
			
			<?php }	?>
            </table>
            <?php
            	} //Om det inte finns någon invite
            ?>
          
        <?php 
        	//$user_id = $_SESSION['userid'];
        	$sql_user = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id = '$user_id' "));
        	$email = $sql_user['email']; 	
        ?>    
        <div style="text-align:center"> <img class="profile-picture" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $email ) ) ); ?>?s=200&r=r&d=<?php echo urlencode('http://doom.tidaa.se/kj/file.png');?>"></div>
        <div style="text-align: center">
			<form action="logout.php">
				<input style="text-align:center" class="btn" type="submit" value="Logout"/>
            </form>
			</div>
           <!-- <form ng-submit="save()" class="contactForm" name="form" ng-hide="loaded">
                <input class="input" required="required" type="text" name="name" placeholder="your name" ng-model="message.name" />
                <input class="input email" required="required" type="email" name="email" value="" placeholder="your email" ng-model="message.email" /><br />
                <textarea class="textarea" rows="5" required="required" placeholder="your message" ng-model="message.text" ></textarea>
                <button class="btn green">send message</button>
            </form> -->

            <!-- contact us form response messages -->
            <div ng-show="process" style="text-align:center">
                <img class="loader" src="images/loader.png" />
            </div>
            <div ng-show="success"><p>Your message has been sent, thank you.</p></div>
        </div>
        
        <!---- Imagw upload --->
        
       

        
        <!--- Image upload end --->
        
    </div>

    <!-- main content -->
    <div style="position:relative">
        <div style="width:100%" ng-view ng-animate="{enter: 'view-enter', leave: 'view-leave'}"></div>
    </div>
    
    
    

</body>
</html>
