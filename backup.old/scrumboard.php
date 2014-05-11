<?php
	$id = $_GET['id'];
	
	//include_once('config.php');
	
	//if(login_check($con)){
	if(true){
	?>
		<div class="scrum_frame" style="width: 100%; height: 75%;">
			<iframe src="http://doom.tidaa.se:1338/<?php echo $id; ?>" style="width: 100%; height:100%; border: none;"></iframe>
		</div>
	
	<?php }else{
		echo "Sign in first.. please";
	}
?>