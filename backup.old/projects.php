<div style="width:100%">

<?php
	//$result=mysql_query("SELECT * FROM `project` WHERE `id` > 0");
	$user_id = $_SESSION['user_id'];
	
	$result=mysql_query("SELECT project_id FROM `members_project` WHERE `user_id` = $user_id");
	
	
	$colors=array("#87b822", "#3f91d2", "#f1784d", "#f0c42c");
	$i=0;
	while($row1=mysql_fetch_assoc($result)){
		
		$proj_id = $row1['project_id'];
		//echo $proj_id;
		$result_proj=mysql_fetch_assoc(mysql_query("SELECT * FROM `project` WHERE `id` = $proj_id")); ?>
	
	<?php
	$result_start_date = date("Y-m-d",$result_proj['start_date']);
	
	$result_end_date = date("Y-m-d",$result_proj['end_date']);
	
	$date = date('Y-m-d');

	
	$startDate= new DateTime($date);
	$endDate = new DateTime($result_end_date);
	$interval = $endDate->diff($startDate);
	

	

	
	?>
			<a class="projectObj" href="?page=showProject&id=<?php echo $result_proj['id']; ?>" style="background-color:<?php if($i>=4){$i=0;} echo $colors[$i]; $i++; ?>; ">
		        <div class="wrap" >
		            <div class="name"><?php echo $result_proj['name']; ?> <?php ?> - <?php if($startDate>$endDate){
		echo 'Expired';
	} else{
			echo $interval->format('%a days')." days left\n";
		}?> </div>
		            <div class="desc"><p><?php echo $result_proj['description'];?></p></div>
		            
		        </div>
		    </a>

	<?php
	}
		
	?>

<script>
$('.projectObj').bind('click', function (e) {
    e.preventDefault();

    var me = this;
    var width = $(me).width() / 1.5;
    $(me).find('.wrap').width($(me).find('.wrap').width());

    $(me).animate({
        opacity: 0,
        marginLeft: -width
    }, 500);

    var delayN = 150;
    var delayP = 150;

    var nextEl = $(me).nextAll('.projectObj');
    var prevEl = $(me).prevAll('.projectObj');

    nextEl.each(function (index, elem) {
        setTimeout(function () {
            
            $(elem).find('.wrap').width($(elem).find('.wrap').width());

            $(elem).animate({
                opacity: 0,
                marginLeft: -width
              }, 500, function () {
            });
        }, delayN);
        delayN += 100;
    });

    prevEl.each(function (index, elem) {
        setTimeout(function () {
            $(elem).find('.wrap').width($(elem).find('.wrap').width());

            $(elem).animate({
                opacity: 0,
                marginLeft: -width
              }, 500, function () {
            });
        }, delayP);
        delayP += 100;
    });

    setTimeout(function () {
        document.location = $(me).attr('href');
    },1000)

    return false;
});
</script>