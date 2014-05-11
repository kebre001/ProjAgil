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
		
		<!-- Burndownchart scrips-->
	<script src="../chart/RGraph.common.core.js" ></script>
    <script src="../chart/RGraph.common.dynamic.js" ></script>
    <script src="../chart/RGraph.common.tooltips.js" ></script>
    <script src="../chart/RGraph.common.effects.js" ></script>
    <script src="../chart/RGraph.common.key.js" ></script>
    <script src="../chart/RGraph.drawing.yaxis.js" ></script>
    <script src="../chart/RGraph.line.js" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
    
    
     <script>
        $(document).ready(function ()
        {
            var line = new RGraph.Line('cvs', [100,90,80,70,60,50,40,30,20,10])
                .set('labels', [1,2,3,4,5,6,7,8,9,10])
                .set('shadow', false)
                .set('background.grid.autofit.numvlines', 9)
                .set('noxaxis', true)
                .set('title', 'Burndown Chart')
                .set('noyaxes', false)
                .set('colors', ['#000','#76D0FF'])
                .set('tickmarks', 'dot')
                .set('tickmarks', function (obj, data, value, index, x, y, color, prevX, prevY)
                {
                    obj.context.beginPath()
                    obj.context.lineWidth = 1;
                   
                    obj.context.arc(x, y, 2, 0, RGraph.TWOPI, false)
                    obj.context.fill()
                    obj.context.stroke()
                })
                
                .set('ylabels', true)
                .set('shadow', false)
                .set('linewidth', 1)
                .set('text.color', '#000')
                .on('beforedraw', function (obj)
                {
                    RGraph.clear(obj.canvas, 'white');
                })
                
    
                .draw();  
                
        
        })
    </script>

    <!-- /Burndownchart scrips-->
    
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
  
  <!-- Till flikarna och dylikt-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
  <link href="css/flikar.css" rel="stylesheet">
  
  
 <script>
  $(function() {
    $( "#datepicker" ).datepicker({
	    dateFormat: 'yy-mm-dd'
    });
  });
  </script>
  
  <script>
  $(function() {
    $( "#datepicker2" ).datepicker({
	    dateFormat: 'yy-mm-dd'
    });
  });
  </script>
  
  <script>
			  $(function() {
				var pickerOpts={dateFormat: "yy-mm-dd"};
				$( "#datepicker" ).datepicker(pickerOpts);
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
			
		
	</head>
	<body style="background-color:#e6e6e6">
	
	
	<!-- FLIKAR FLIKAR FLIKAR -->
	
	<div class="wrapper">
     
        
        <div class="tabs">
          <a href="#" data-tab="1" class="tab descr active">Description</a>
          <a href="#" data-tab="2" class="tab">Users</a>
          <a href="#" data-tab="3" class="tab">Backlog</a>
          <a href="#" data-tab="4" class="tab sprint">Sprint</a>
          <a href="#" data-tab="5" class="tab">Burndown</a>
          <a href="#" data-tab="6" class="tab">Scrumboard</a>
           <a href="#" data-tab="7" class="tab">Chat</a>
            <a href="#" data-tab="8" class="tab">Documents</a>
             <a href="#" data-tab="9" class="tab">Edit project</a>
                    
                    

		  <div data-content="1" class="content descr active">
			  
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
			  
		  </div>
		  
		  <div data-content="2" class="content">
		  
		  <!--- Users in project --->
	<small style="color:black">Medlemmar i projektet</small><br>
	<div class="project-users" style="background-color:#e6e6e6; height: 100% !important; width: 100% !important;">
	
	
	
	<table style="width:100%; height:100%;">
		<tr>
		    <th style="color:black">Name</th>
		    <th style="color:black">Email</th>
		    <?php 
		    	echo "<th style='color:black'>Remove</th>";
		    	echo "<th style='color:black'>Permissions</th>";	
		    ?>
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
				    <td><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
				    <!--
				  <!---   <td><a href="mailto:<?php echo $user['email']; ?>"><img src="http://oregoncomp.com/wp-content/uploads/2010/11/envelope-icon.jpg"></a></td> --->
			
				    <?php //if($admin){ ?>
				    <!---<td style="text-align:center;"><a href="remove_user.php?id=<?php echo $user['id']; ?>" style="color:red;">X</a></td> --->				
				    
				    <td style="text-align:center;">
				    <?php 
				    	$queryPerm=mysql_query("SELECT * FROM `members_project` WHERE `user_id` = $sessionid AND `project_id` = $projId");
						$queryPermission=mysql_fetch_assoc($queryPerm);
					    if($queryPermission['permissions']=="2" && $permissions=="0" || $queryPermission['permissions']=="2" && $permissions=="1"){ ?>
			    			<form action="?page=process_invite" method="POST">
					    	<input type="hidden" value="<?php echo $projId ?>" name="proj_id">
					    	<input type="hidden" value="<?php echo $user['id'] ?>" name="user_id">
					    	<input type="submit" name="submit" value="X" style="color:#FF0000">
						    </form>
						    </td>
					<?php 	}else if($permissions=="2"){
								echo "<h4 style='color:black;'>Project creator</h4>";
							}else{
								echo "<h4 style='color:black;'>Not available for admin/member</h4>";
							} 
					?>

				    <td style="text-align:center;">
				    
				    <?php 
				    
				    
				    
				    if($permissions == "2"){ 
						echo "<h4 style='color:black;'>Project creator</h4>";
					}else if($queryPermission['permissions']=="1" && $permissions == "1" || $queryPermission['permissions']=="0" && $permissions == "1"){
						echo "<h4 style='color:black;'>Admin</h4>";
					}else if($queryPermission['permissions']=="0" && $permissions == "0"){
						echo "<h4 style='color:black;'>Member</h4>";
					}else{
						if($queryPermission['permissions']=="2" && $permissions=="0" || $queryPermission['permissions']=="2" && $permissions=="1" || $queryPermission['permissions']=="1" && $permissions=="0"){
									
				    ?> 
							<form action="?page=process_invite" method="POST">
							<select name="permission" onChange="submit();">;
							<?php if($permissions=="1"){?>
								<option value="1" selected="TRUE">Admin</option>
								<option value="0">Member</option>
							<?php }else{ ?>
								<option value="1">Admin</option>
								<option value="0" selected="TRUE">Member</option>
							<?php } ?>
								</select>
								<input type="hidden" value="<?php echo $projId; ?>" name="proj_id">
								<input type="hidden" value="<?php echo $user['id']; ?>" name="user_id">
								<input type="hidden" name="perms" value="permission">
							</form>
						</td>
					<?php 
						}
					}
				//} 	?>
				 </tr>
			
		<?php }	?>
		</table>
		
		<form action="?page=process_invite" method="POST">
				<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></input>
				<input type="hidden" name="id" value="<?php echo $projId;?>"></input>
				<input type="text" name="email" placeholder="Email" style="font-size:16px; font-family:Tahoma;"></input>
				<button>Invite</button>
			</form>
			<small style="color:red">Only admins can invite users to this project.</small>
	</div>
	<!--- slut users --->


			  
		  </div>
		  
          <!-- Backlog -->
          <div data-content="3" class="content">
          
          <section class="addbar">
			  <a class="addItem" href="javascript: void(0)">Add Item</a>
			  
			  	
			  </section>
            <section id="backlog-items">
            
             <?php

				 $querybacklogitem=mysql_query("SELECT * FROM `backlog` WHERE `project_id` = $projId");
				 
				 while($row=mysql_fetch_assoc($querybacklogitem)){?>
					 
					 <div class="ui-state-default backlog-item">
			              	
			              	<div>
			                	<p><?php echo $row['title']; ?></p>
			              	</div>
			              	<div>
			              		<p>Est. days: <?php echo $row['estdate']; ?></p>
			              	</div>
			  	
			              	
			              </div>
              

					 
				<?php } ?>

             
            </section>

            
          </div>


          <!-- Sprint -->
          <div data-content="4" class="content sprint">
          <br>
          	<!-- Backlog items hämtat från databasen -->	
		  	<section id="sortable1" class="connectedSortable items-from-backlog">
		  	
		  	<section>
					 <div class=" ui-helper-reset">
			              	
			              	<div>
			                		<p>Backlog Items</p>
			              	</div>
			         </div>
		    </section>
	          
              	
             <?php

				 $querybacklogitem=mysql_query("SELECT * FROM `backlog` WHERE `project_id` = $projId");
				 
				 while($row=mysql_fetch_assoc($querybacklogitem)){?>
				 <section>
					 <div class="backlog-item ui-state-default ui-helper-reset">
			              	
			              	<div>
			                	<p><?php echo $row['title']; ?></p>
			              	</div>
			              	<div>
			              		<p>Est. days: <?php echo $row['estdate']; ?></p>
			              	</div>

					 </div>
					 </section>
				<?php } ?>
	          
		  	
	
	
		  	
		  	</section>

		  	<section class="addbar" style="width: 60%;">
				  	<a class="addSprint" href="javascript: void(0)">Add sprint</a>
			</section>
			
          	<section id="sprint-items" >
			  	
			  	
			  
			<?php $querybacklogitem=mysql_query("SELECT * FROM `sprint` WHERE `project_id` = $projId");
				 
				 while($row=mysql_fetch_assoc($querybacklogitem)){?>
				 <div class="sprint-item" style="color: black; font-family: 'heiti TC';" >
			              	<div style="margin-left:2%;">
			                	<p><?php echo $row['title']; ?></p>
			              	</div>
			              	<div style="margin-left:2%; font-family: 'heiti TC';">
			              		<p>Est. days: <?php echo $row['estdate']; ?></p>
			              	</div>
			     <section id="sortable2" class="connectedSortable backlog-item"></section>
				 </div>
			  	

				<?php } ?>
			
          	</section>
		  
		  
		            
          </div>

          <!-- Burndown -->
          <div data-content="5" class="content">
          
          <div class="center"><canvas id="cvs" width="600" height="250" style="border-radius: 5px; #fff">[No canvas support]</canvas></div>
          
          
          </div>
          
          <!-- Burndown slut -->
          
          
                   <!-- Scrumboard flik -->
                   
          <div data-content="6" class="content">
    <!--      
              <div class="paddRow scrumboard" name="bottom_Scrum" >
        <div class="wrap_scrum">
            <img class="close" src="images/close.png" ng-click="closeScrumboard()" />
            -->
			<div class="scrum_frame" seamless="seamless" scrolling="no" style="width: 100%; height: 670px; overflow:hidden;">
					<?php //MD5 kryptering av projektets id och projektets namn. T.ex ID: 17 Name: Test blir 17Test och sedan MD5 på det ?>
		
				<iframe src="http://doom.tidaa.se:1338/<?php echo md5($projId . $result['name']); ?>" style="width: 100%; height:100%; border: none;"></iframe>
			</div>
       <!-- </div>

    </div>-->
          </div>
           <!-- Scrumboard flik slut-->
           
             <!-- Chat Join -->
          <div data-content="7" class="content">
          
          				<small style="color:red" style="background-color:black !important">Om du är ansluten till chatten kommer du bli ombedd om bekräftelse när du lämnar hemsidan (gäller även vid uppdatering)</small>
				<iframe src="http://irc.doom.tidaa.se:7778/?nick=<?php echo $current_user['username'] ?>#<?php echo md5($projId . $result['name']); ?>" style="width: 100%; height:100%; border: none;"></iframe>   
			      

          
          </div>
          
          <!-- Chat Join slut -->
          
          
              <!-- Docuement flik  -->
          <div data-content="8" class="content">
          
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
						    	<input type="hidden" value="<?php echo $projId; ?>" name="proj_id">
						    	<input type="hidden" value="<?php echo $sessionid; ?>" name="user_id">
						    	<input type="hidden" value="<?php echo $row['id']; ?>" name="doc_id">
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
						
						<input type="hidden" value="<?php echo $projId; ?>"  name="proj_id">
						<input type="submit" name="submit" value="Create">
					</form>
					<!-- <small style="color:red">Use unique names for your files</small> --->
				</div>
          
          </div>
          
          <!-- Dokument flik slut -->
          
           <!--  flik  -->
          <div data-content="9" class="content">
          
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
							<!-- 
							
							<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="date1" value="<?php echo date("Y-m-d", $project['start_date']) ?>"><br>
							<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="date2" value="<?php echo date("Y-m-d", $project['end_date']) ?>"><br>
							--->
			<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="datepicker" value="<?php echo date("Y-m-d", $project['start_date']) ?>"><br><br>
				<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="datepicker2" value="<?php echo date("Y-m-d", $project['end_date']) ?>"><br>
				
				<br>
				<br>
				
					<input type="hidden"  value="<?php echo $projId?>" name="proj_id">					
					<input type="submit" value="Submit">
				
					</div>
					<div id="col_3" style="width: 30%; float:left">
							
					</div>
				
	        	</form>
	        	<form action="#" method="post">
	        		<input type="hidden" value="<?php echo $projId ?>" >
					<input type="submit" value="Remove">
	        	</form>
          
          </div>
          
          <!--  flik slut -->
          
          
          <!-- new backlog item form -->
          <div id="add-backlog-form" title="Add new backlog item">
			  <form action="createbacklog.php" method="POST">
				  <fieldset>
					  <label for="title">Title for new item</label>
					  <input type="text" value="title" name="title" id="title" class="text ui-widget-content ui-corner-all">
					  <label for="estday">Est. days</label>
					  <input type="text" onkeypress="return isNumberKey(event)" name="estday" id="estday" value="estday" class="text ui-widget-content ui-corner-all">
					  <input type="hidden" value="<?php echo $projId; ?>" name="proj_id" id="proj_id">
					  <input type="hidden" value="<?php echo $user['id']; ?>" name="user_id" id="user_id">
					  <input type="hidden" value="backlog" name="type" id="type">
				 </fieldset>
			</form>
		</div>  
               
              
        <!-- new sprint item form -->
          <div id="add-sprint-form" title="Add a new sprint">
			  <form>
				  <fieldset>
				  	
					  <label for="title">Title for sprint</label>
					  <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all">
					  <label for="estday">Est. days</label>
					  <input type="text" onkeypress="return isNumberKey(event)" name="estday" id="estday" value="" class="text ui-widget-content ui-corner-all">
					  <input type="hidden" value="<?php echo $projId; ?>" name="proj_id" id="proj_id">
					  <input type="hidden" value="<?php echo $user['id']; ?>" name="user_id" id="user_id">
					  <input type="hidden" value="sprint" name="type" id="type">
				 </fieldset>
			</form>
		</div>        
               
              
              	
                    	
       </div>
      
      
   
    </div>
  
  
  
    
  <script>
  
  function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
  
    // Backlog dragable   
    $(function() {
      $( "#backlog-items" ).sortable({
        placeholder: "ui-state-highlight"
      });
      $( "#backlog-items" ).disableSelection();
    });

	// Sprint dragable
	$(function() {
      $( "#sprint-items" ).sortable({
        placeholder: "ui-state-highlight"
      });
      $( "#sprint-items" ).disableSelection();
    });


    // Tabs
    $(function () {
      $('[data-tab]').on('click', function (e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active')
          .siblings('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');
        e.preventDefault();
      });
    });
  </script>
  
  
  <script>
  $(function() {
    var title = $( "#title" ),
      estday = $( "#estday" ),
      prio = $( "#prio" ),
      projid = $( "#proj_id" ),
      userid = $( "#user_id" ),
      type = $( "#type" ),
      allFields = $( [] ).add( title ).add( estday ).add( prio ).add( projid ).add( userid ).add( type );
          
     $( "#add-backlog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Save": function() {
        	
        	$.ajax
                    ({
                    type: "POST",
                    url: "createbacklogsprint.php",
                    cache: false,
                    data: allFields,
                    success: function(data)
                        {
                        	alert(data);
                        }
                    });
        	
            $( "#backlog-items" ).append( 
            "<div class=\"ui-state-default backlog-item\">" +
              
              "<div><p>" + title.val() + "</p></div>" +
              "<div><p>Est. days: " + estday.val() + "</p></div>" +
			  "<div><p>" + "</p></div>" +
            "</div>" );
            $( this ).dialog( "close" );
          
        },
        Cancel: function() {
            $( this ).dialog( "close" );
          
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );	
      }
    });
    
    


 
    $( ".addItem" )
      .button()
      .click(function() {
        $( "#add-backlog-form" ).dialog( "open" );
      });
    
  });
  </script>
  
  
  <script>
  $(function() {
    var title = $( "#title" ),
      estday = $( "#estday" ),
      prio = $( "#prio" ),
      projid = $( "#proj_id" ),
      userid = $( "#user_id" ),
      type= $( "#type" ),
      allFields = $( [] ).add( title ).add( estday ).add( prio ).add( projid ).add( userid ).add( type );
  
      $( "#add-sprint-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Save": function() {
			
        	$.ajax
            ({
            type: "POST",
            url: "createbacklogsprint.php",
            cache: false,
            data: allFields,
            success: function(data)
                {
                	alert(data);
                	//$( ".tab.descr" ).toggleClass( "active" )
					//$( ".content.descr").toggleClass( "active" )

					//$( ".tab.sprint" ).toggleClass( "active" );
					//$( ".content.sprint" ).toggleClass( "active" );
					//location.reload();
                }
            });
        
            $( "#sprint-items" ).append( 
            "<div class=\"sprint-item\" style=\"color: black;\">" +
              "<div><p>" + title.val() + "</p></div>" +
              "<div><p>Est. days: " + estday.val() + "</p></div>" +
			  "<section id=\"sortable2\" class=\"connectedSortable backlog-item ui-sortable\">" + "</section>" +		
            "</div>" );
            
            
            //location.reload();
            //$( ".tab.descr" ).toggleClass( "active" )
			//$( ".content.descr").toggleClass( "active" )

			//$( ".tab.sprint" ).toggleClass( "active" );
			//$( ".content.sprint" ).toggleClass( "active" );
            
			
            $( this ).dialog( "close" );
          
          
        },
        Cancel: function() {
            $( this ).dialog( "close" );
          
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );	
      }
    });
  
       $( ".addSprint" )
      .button()
      .click(function() {
        $( "#add-sprint-form" ).dialog( "open" );
      });
  });
  </script>
 
 <script>
  $(function() {
    $( "section.backlog-item" ).sortable({
      	connectWith: ".connectedSortable"
    });
    
    $( "section.items-from-backlog" ).sortable({
	    connectWith: ".connectedSortable"
    });
    
    $( "#sortable1, #sortable2" ).disableSelection();
  });
  </script>
	
	
	<!-- SLUT PÅ FLIKAR SLUT PÅ FLIKAR -->
	
	
	
	
	
	
	
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
	<!--
	<a href="#!#bottom_Scrum">Jump to Scrumboard</a>
	--->
	
	<!--- ALLA SLIDE DOWNS --->
	<!--- Edit Desc --->
	
	<!----
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
							<!-- 
							
							<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="date1" value="<?php echo date("Y-m-d", $project['start_date']) ?>"><br>
							<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="date2" value="<?php echo date("Y-m-d", $project['end_date']) ?>"><br>
							--->
							<!----
			<span style="font-size:1.5em">Start date: </span><br><input type="text"  name="startDate" id="datepicker" value="<?php echo date("Y-m-d", $project['start_date']) ?>"><br><br>
				<span style="font-size:1.5em">End date: </span><br><input type="text"  name="endDate" id="datepicker2" value="<?php echo date("Y-m-d", $project['end_date']) ?>"><br>
				
				<br>
				<br>
				
					<input type="text" hidden="TRUE" value="<?php echo $projId?>" name="proj_id">					
					<input type="submit" value="Submit">
				
					</div>
					<div id="col_3" style="width: 30%; float:left">
							
					</div>
				
	        	</form>
	        	<form action="#" method="post">
	        		<input type="text" value="<?php echo $projId ?>" hidden="TRUE">
					<input type="submit" value="Remove">
	        	</form>
			</div>
		</div>
	<!--- /Edit Desc --->
		<!--- chat --->
	    <div class="paddRow chat" >
        	<div class="wrap_chat">

			</div>
		</div>
		<!--- /chat --->
			<!-- Invite slidedown -->
    <div class="paddRow invite" >
        <div class="wrap_invite">
            <img class="close" src="images/close.png" ng-click="closeInvite()" />
            
			<form action="?page=process_invite" method="POST">
				<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></input>
				<input type="hidden" name="id" value="<?php echo $projId;?>"></input>
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
						    	<input type="hidden" value="<?php echo $projId; ?>" name="proj_id">
						    	<input type="hidden" value="<?php echo $sessionid; ?>" name="user_id">
						    	<input type="hidden" value="<?php echo $row['id']; ?>" name="doc_id">
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

	<!--- SLUT PÅ ALLA SLIDE DOWNS --->
	</body>
</html>
<?php
}else{
		echo 'You have no permission for this project';
	}
?>