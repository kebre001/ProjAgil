<?php

require '../../PHPMailer/PHPMailerAutoload.php';

class Count {
	public function fetch_all($what_to_count) {
		global $pdo;

		$query = $pdo->prepare("SELECT COUNT(`id`) FROM ? WHERE `id` > 0");
		$query->bindValue(1, $what_to_count);
		$query->execute();
		
		return $query->fetch();
	}
	public function fetch_data($what_to_count) {
		global $pdo;

		$query = $pdo->prepare("SELECT COUNT(`id`) FROM ? WHERE `id` > 0");
		$query->bindValue(1, $what_to_count);
		$query->execute();
		
		return $query->fetch();
	}
}

function proj_session_start() {
        $session_name = 'proj_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		session_set_cookie_params(604800,"/");
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.     
}

function login($email, $password, $mysqli) {
   // Using prepared Statements means that SQL injection is not possible. 
   if ($stmt = $mysqli->prepare("SELECT id, username, password_hash, password_salt FROM user WHERE email = ? OR username = ? LIMIT 1")) { 
      $stmt->bind_param('ss', $email, $email); // Bind "$email" to parameter.
      $stmt->execute(); // Execute the prepared query.
      $stmt->store_result();
      $stmt->bind_result($user_id, $username, $db_password, $salt); // get variables from result.
      $stmt->fetch();
      $password = hash('sha256', $password.$salt); // hash the password with the unique salt.
 
      if($stmt->num_rows == 1) { // If the user exists
         // We check if the account is locked from too many login attempts
         if(checkbrute($user_id, $mysqli) == true) { 
            // Account is locked
            // Send an email to user saying their account is locked
            return false;
         } else {
         if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
            // Password is correct!
 
 
               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
               $_SESSION['user_id'] = $user_id; 
               $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
               $_SESSION['username'] = $username;
               $_SESSION['login_string'] = hash('sha256', $password.$user_browser);
               // Login successful.
               return true;    
         } else {
            // Password is not correct
            // We record this attempt in the database
            $now = time();
            $mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
            return false;
         }
      }
      } else {
         // No user exists. 
         return false;
      }
   }
}

function checkbrute($user_id, $mysqli) {
   // Get timestamp of current time
   $now = time();
   // All login attempts are counted from the past 2 hours. 
   $valid_attempts = $now - (2 * 60 * 60); 
 
   if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
      $stmt->bind_param('i', $user_id); 
      // Execute the prepared query.
      $stmt->execute();
      $stmt->store_result();
      // If there has been more than 5 failed logins
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

function login_check($mysqli) {
   // Check if all session variables are set
   if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
     $user_id = $_SESSION['user_id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['username'];
 
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
     if ($stmt = $mysqli->prepare("SELECT password_hash FROM user WHERE id = ? LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($password); // get variables from result.
           $stmt->fetch();
           $login_check = hash('sha256', $password.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
              return true;
           } else {
              // Not logged in
              return false;
           }
        } else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}

function createProject($projectData){
	array_walk($projectData, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($projectData)) . '`';
	$data ='\'' . implode('\', \'', $projectData) . '\'';
	
	mysql_query("INSERT INTO `project` ($fields) VALUES ($data)");
}

function isValidPage($page)
{
     $validpages = array("cproject","process_login","projects","showProject","cprojectxtra","privacy","projsettings","adduser", "process_invite", "irc", "scrumboard", "home", "createDoc", "document", "register", "edesc");

     if(in_array($page,$validpages) && file_exists($page . '.php'))
     {
          return TRUE;
     } else {
          return FALSE;
     }
}

function checkProjectInv($projId, $userId){
	$queryInv=mysql_fetch_assoc(mysql_query("SELECT `id` FROM `members_project` WHERE `user_id` = $userId AND `project_id` = $projId"));
	
	if(!empty($queryInv)){
		return TRUE;
	}else{
		return FALSE;
	}
	
}

function checkInbox($id){
	$checkQuery = mysql_fetch_assoc(mysql_query("SELECT * FROM `invites` WHERE `user_id`= '$id'"));
	if(!empty($checkQuery)){
		return TRUE;
	}else{
		return FALSE;
	}
}

function checkActivation($id){
		//Om man är aktiverad så får man TRUE som svar annars FALSE
	$sql = mysql_query("SELECT * FROM activation WHERE user_id = '$id'");
	$result = mysql_fetch_assoc($sql);
	if(empty($result)){
		return TRUE;
	}else{
		return FALSE;
	}	
}

function activateCode($code){
	$sql = mysql_query("DELETE FROM activation WHERE activation_code = '$code'");
	$result = mysql_fetch_assoc($sql);
	if(empty($result)){
		return FALSE;
	}else{
		return TRUE;
	}	
}

function sendActivation($email, $code){
	$mail = new PHPMailer;


	$mail->From = 'bot@doom.tidaa.se';
	$mail->FromName = 'ProjAgil';

	$mail->addAddress($email);               // Name is optional
	
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = 'ProjAgil Registration';
	$mail->Body    = '
						Please activate your account on ProjAgil <br>
						<a href="http://doom.tidaa.se/Demo/sources359/activation.php?code=' . $code . '></a>
					 
					 ';
	$mail->AltBody = 'Please activate your account on ProjAgil: http://doom.tidaa.se/Demo/sources359/activation.php?code=' . $code . '';
	
	if(!$mail->send()) {
		return false;
	}else{
		return true;
	}
}

function createActivity(){
	//Kod som lägger in något i DB('activity')
	
}

function getErrorMessage($id){
	if($id == 1){
		return "Error 1";
	}else if($id == 2){
		return "Error 2";
	}
	else{
		return "Unknown error.. :'(";
	}
}

?>