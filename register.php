<?php

include ('config.php');
include ('functions.php');

proj_session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

if(!empty($_SESSION['user_id'])){
	header('Location: index.php');
}

$escapedUsername = mysql_real_escape_string($_POST['username']); # use whatever escaping function your db requires this is very important.
$escapedPW = mysql_real_escape_string($_POST['password2']);
$escapedFname = mysql_real_escape_string($_POST['fname']);
$escapedLname = mysql_real_escape_string($_POST['lname']);
$escapedEmail = mysql_real_escape_string($_POST['email']);

# generate a random salt to use for this account

if(empty($escapedUsername) or empty($escapedPW) or empty($escapedEmail)){ //Checks if empty field
        $error = 'All fields required';
        } else {
                if (!filter_var($escapedEmail, FILTER_VALIDATE_EMAIL)) { //Checks if valid Email
                        $error = 'Invalid e-mail address';
                }
                else {
				
						$check_email=mysqli_query($con, "SELECT * FROM user WHERE email = '$escapedEmail'");
						$check_username=mysqli_query($con, "SELECT * FROM user WHERE username = '$escapedUsername'");
				
                        if(mysqli_num_rows($check_email) > 0 ) { //check if email already exist
                                $error = 'E-mail already in use!';
                        }elseif(mysqli_num_rows($check_username) > 0 ){ //Check if there username already exist
								$error = 'Username already in use!';
						}else {
                                $activation = md5(uniqid(rand(), true));

                                $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

                                $saltedPW =  $escapedPW . $salt;

                                $hashedPW = hash('sha256', $saltedPW);
								
								$registrationDate = time();

                                $sql_add = "INSERT INTO user (firstname, lastname, email, username, password_salt, password_hash, registration_date) 
								VALUES ('$escapedFname', '$escapedLname', '$escapedEmail', '$escapedUsername', '$salt', '$hashedPW', '$registrationDate')";

                                $result_add = $con->query($sql_add) or die($con->error);
                                
                                //Hämta användarens id
                                $sql_user = mysql_query("SELECT * FROM user WHERE email = '$escapedEmail'");
                                $user = mysql_fetch_assoc($sql_user);
                                $user_id = $user['id'];
                                
                                $sql_activation = "INSERT INTO activation (user_id, activation_code) VALUES ('$user_id', '$activation')";
                                
                                $result_activation = mysql_query($sql_activation);

								if(sendActivation($escapedEmail, $activation) == FALSE){
									echo "Mail did not get out";
									echo "<br>";
									echo "To activate use this URL";
									echo "<br>";
									echo '<a href="activation?code=' . $activation . '>ACTIVATE</a>';
								}

                                proj_session_start();
                                header('Location: activation.php');
                                
                        }
                }
        }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Register</title>
        
        <!-- The stylesheet -->
        <link rel="stylesheet" href="css/register.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    </head>
    
    <body>

        <div id="main">
        	
        	<h1>Sign up, it's FREE!</h1>
        	
        	<form class="form" method="post" action="register.php">
        		<div class="row name">
	    			<input type="text" id="fname" name="fname" placeholder="First Name" />
        		</div>
        		
        		<div class="row name">
	    			<input type="text" id="lname" name="lname" placeholder="Last Name" />
        		</div>
				
				<div class="row name">
	    			<input type="text" id="username" name="username" placeholder="Username" />
        		</div>
        		
        		<div class="row email">
					<!--- Sneaky funktion om någon fyllt i email så används samma för registrering --->
	    			<input type="text" id="email" value="<?php echo $_GET['email']; ?>" name="email" placeholder="Email" />
        		</div>
        		
        		<div class="row pass">
        			<input type="password" id="password1" name="password1" placeholder="Password(Must be complex)" />
        		</div>
        		
        		<div class="row pass">
        			<input type="password" id="password2" name="password2" placeholder="Password (repeat)" disabled="true" />
        		</div>
        		
        		<!-- The rotating arrow
        		<div class="arrowCap"></div>
        		<div class="arrow"></div>
        		
        		<p class="meterText">Password Meter</p>
        		--->
        		<input id="submit" name="submit" type="submit" value="Register" />
        		
        	</form>
        </div>
        
        <!-- JavaScript includes - jQuery, the complexify plugin and our own script.js -->
        <script src="js/jquery-2.0.3.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
		<script src="script.js"></script>
		

		     
    </body>
</html>