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
            


			<div class="newsfeed"> 
			
				<div class="feedx"><p></p></div>
				<div class="feedx"><p>Newsfeed1</p></div>
				<div class="feedx"><p>Newsfeed2</p></div>
				<div class="feedx"><p>Newsfeed3</p></div>
				<div class="feedx"><p>Newsfeed4</p></div>
				
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
            minDate: 0,
            onSelect: function (date) {
                var dt2 = $('#date2');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                //sets dt2 maxDate to the last day of 30 days window
                dt2.datepicker('option', 'maxDate', startDate);
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
            <!--- Slut på invites --->
            
            <!---- Imgae upload form --->
             <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
Select Image File:
<input type="file" name="userfile"  size="40">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
<select name="image_ctgy">
<option value="animals">Animals</option>
<option value="vegetables">Vegetables</option>
<option value="minerals">Minerals</option>
</select>
<br />
<input type="submit" name="submit" value="submit">
</form>



			<!--- End image upload form --->
            
            <!--- Image --->
          <?php

/*** check if a file was submitted ***/
if(!isset($_FILES['userfile'], $_POST['image_ctgy']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        }
    catch(PDOException $e)
        {
    echo '<h4>'.$e->getMessage().'</h4>';
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }
    }


/**
 *
 * the upload function
 * 
 * @access public
 *
 * @return void
 *
 */
function upload(){
$allowed = array("image/jpeg", "image/gif", "application/pdf");
/*** check if a file was uploaded ***/
if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false)
    {
    /*** an array of allowed categories ***/
    $cat_array = array("animals", "vegetables", "minerals");
    if(filter_has_var(INPUT_POST, "notset") !== false || in_array($_POST['image_ctgy'], $cat_array) !== false)
        {
        $image_ctgy = filter_input(INPUT_POST, "image_ctgy", FILTER_SANITIZE_STRING);
        }
    else
        {
        throw new Exception("Invalid Category");
        }
    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);

    /*** assign our variables ***/
    $image_type   = $size['mime'];
    $imgfp        = fopen($_FILES['userfile']['tmp_name'], 'rb');
    $image_width  = $size[0];
    $image_height = $size[1];
    $image_size   = $size[3];
    $image_name   = $_FILES['userfile']['name'];
    $maxsize      = 99999999;

    /***  check the file is less than the maximum file size ***/
    if($_FILES['userfile']['size'] < $maxsize )
        {
        /*** create a second variable for the thumbnail ***/
        $thumb_data = $_FILES['userfile']['tmp_name'];

        /*** get the aspect ratio (height / width) ***/
        $aspectRatio=(float)($size[0] / $size[1]);

        /*** the height of the thumbnail ***/
        $thumb_height = 100;

        /*** the thumb width is the thumb height/aspectratio ***/
        $thumb_width = $thumb_height * $aspectRatio;

        /***  get the image source ***/
        $src = ImageCreateFromjpeg($thumb_data);

        /*** create the destination image ***/
        $destImage = ImageCreateTrueColor($thumb_width, $thumb_height);

        /*** copy and resize the src image to the dest image ***/
        ImageCopyResampled($destImage, $src, 0,0,0,0, $thumb_width, $thumb_height, $size[0], $size[1]);

        /*** start output buffering ***/
        ob_start();

        /***  export the image ***/
        imageJPEG($destImage);

        /*** stick the image content in a variable ***/
        $image_thumb = ob_get_contents();

        /*** clean up a little ***/
        ob_end_clean();

        /*** connect to db ***/
        $dbh = new PDO('mysql:host=localhost;dbname=projekt;charset=utf8', 'projekt', 'hS35LeJuNABRUBP9');
        //$dbh = new PDO("mysql:host=localhost;dbname=testblob", 'username', 'password');

        /*** set the error mode ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id`= '$user_id'")); 
$userid = 12;

        /*** prepare the sql ***/
        $stmt = $dbh->prepare("INSERT INTO testblob (image_type ,image, image_height, image_width, image_thumb, thumb_height, thumb_width, image_ctgy, image_name, user_id)
        VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $image_type);
        $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
        $stmt->bindParam(3, $image_height, PDO::PARAM_INT);
        $stmt->bindParam(4, $image_width,  PDO::PARAM_INT);
        $stmt->bindParam(5, $image_thumb,  PDO::PARAM_LOB);
        $stmt->bindParam(6, $thumb_height, PDO::PARAM_INT);
        $stmt->bindParam(7, $thumb_width,  PDO::PARAM_INT);
        $stmt->bindParam(8, $image_ctgy);
        $stmt->bindParam(9, $image_name);
        $stmt->bindParam(10,$userid);

        /*** execute the query ***/
        $stmt->execute();
        }
    else
        {
    /*** throw an exception is image is not of type ***/
    throw new Exception("File Size Error");
        }
    }
else
    {
    // if the file is not less than the maximum allowed, print an error
    throw new Exception("Unsupported Image Format!");
    }
}
?>

            <!--- end image --->
            
           

            

         <!--- <a href="#modal"  >   --->
            <!--- Databas image --->
            <?php
/*** Check the $_GET variable ***/
   try    {
          /*** connect to the database ***/
          $dbh = new PDO('mysql:host=localhost;dbname=projekt;charset=utf8', 'projekt', 'hS35LeJuNABRUBP9');

          /*** set the PDO error mode to exception ***/
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          /*** The sql statement ***/
          $sql = "SELECT image_id, thumb_height, thumb_width, image_type, image_name, user_id FROM testblob Order by image_id DESC LIMIT 1";

          /*** prepare the sql ***/
          $stmt = $dbh->prepare($sql);

          /*** exceute the query ***/
          $stmt->execute(); 

          /*** set the fetch mode to associative array ***/
          $stmt->setFetchMode(PDO::FETCH_ASSOC);
		  $test = $_SESSION['user_id'];
          /*** set the header for the image ***/
          foreach($stmt->fetchAll() as $array)
              {
              echo $test;
              echo '<div style="text-align:center">';
             echo '<img class="profile-picture" src="includes/showthumbs.php?image_id='.$array['image_id'].'&user_id='.$array['user_id'].'" alt="'.$array['image_name'].'/" style="width: '.$array['thumb_width'].'px; height: '.$array['thumb_height'].'px;">
            <p>
            </a></p>
            </div>';
            echo '</div>';
            }
        }
     catch(PDOException $e)
        {
        echo $e->getMessage();
        }
     catch(Exception $e)
        {
        echo $e->getMessage();
        }
?>
          </a>
          
         <div id="modal">
		<div class="modal-content">
			<div class="header">
				<h2>Modal Header <---- is modal </h2>
			</div>
			<div class="copy">
				<p>I are modal. How modal are you?</p>
			</div>
			<div class="cf footer">
				<a href="#" class="btn">Close</a>
			</div>
		</div>
		<div class="overlay"></div>
	</div>
	
	
            <!--- end Databas Image ---->
            
          <!---<div style="text-align:center"> <img class="profile-picture" src="images/def.png">  ----->
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
