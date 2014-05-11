

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
<html>
<head>
<script>
    window.onload = function ()
    {
        // The data for the Line chart. Multiple lines are specified as seperate arrays.
        var data = [10,4,17,50,25,19,20,25,30,29,30,29];
    
        // Create the Line chart object. The arguments are the canvas ID and the data array.
        var line = new RGraph.Line("myLine", data)
        
        // The way to specify multiple lines is by giving multiple arrays, like this:
         var line = new RGraph.Line("myLine", [4,6,8], [8,4,6], [4,5,3])
        
            // Configure the chart to appear as you wish.
            .set('background.barcolor1', 'white')
            .set('background.barcolor2', 'white')
            .set('background.grid.color', 'rgba(238,238,238,1)')
            .set('colors', ['red'])
            .set('linewidth', 2)
            .set('filled', true)
            .set('hmargin', 5)
            .set('labels', ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            .set('gutter.left', 40)
        
            // Now call the .draw() method to draw the chart.
            .draw();
    }
</script>

</head>
<body>

<!---<img src="https://chart.googleapis.com/chart?chs=300x140&cht=lc&chco=FF9900,224499&
chd=t:100,90,80,70,60,50,40,30,20,10,1&chls=1|1&
chem=y; chxt=x,y,r; chxr=0,0,500|1,0,200|2,1000,0;dp=2;" />-->

</body>
</html>
