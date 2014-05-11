

<?php

include 'config.php';
include 'functions.php';

/*** Check the $_GET variable ***/
   try    {
         
          $dbh = new PDO('mysql:host=localhost;dbname=projekt;charset=utf8', 'projekt', 'hS35LeJuNABRUBP9');

          /*** set the PDO error mode to exception ***/
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          /*** The sql statement ***/
          $sql = "SELECT * FROM project ORDER BY id DESC LIMIT 5";
          $sql2 = "SELECT * FROM user, project WHERE user.id = project.admin_id ORDER BY project.id DESC LIMIT 5";

		  echo $_SESSION['user_id'];
         		      
		  $stmt2 = $dbh->prepare($sql2);

          /*** exceute the query ***/
          $stmt2->execute(); 

          /*** set the fetch mode to associative array ***/
          $stmt2->setFetchMode(PDO::FETCH_ASSOC);

          /*** set the header for the image ***/
          foreach($stmt2->fetchAll() as $array2)
              {
				  echo $array2['name']." Was created by ".$array2['username'];
				  echo '<br>';
				  
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
