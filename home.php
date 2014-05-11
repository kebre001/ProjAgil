<?php

$first_user_q = mysql_query("SELECT * FROM user ORDER BY registration_date ASC LIMIT 1");
$first_user = mysql_fetch_assoc($first_user_q);

$last_user_q = mysql_query("SELECT * FROM user ORDER BY registration_date DESC LIMIT 1");
$last_user = mysql_fetch_assoc($last_user_q);

?>
<div class="home_container">
	<div class="home_left" style="width:20%; float:left;">
		left
	</div>
	<div class="home_center" style="width: 60%; float:left;">
		center
	</div>
	<div class="home_right" style="width: 20%; float:left; color:black;">
		right
		<div class="stats" style="text-align:center;">
			<table>
				<tr>
					<th>Stats</th>
				</tr>
				<tr>
					<td>Users: <?php echo countTable('user'); ?></td>
				</tr>
				<tr>
					<td>Projects: <?php echo countTable('project'); ?></td>
				</tr>
				<tr>
					<td>Invites: <?php echo countTable('invites'); ?></td>
				</tr>
				<tr>
					<td>Activities: <?php echo countTable('activity'); ?></td>
				</tr>
				<tr>
					<td>Documents: <?php echo countTable('document'); ?></td>
				</tr>
				<tr>
					<td>First member: <br><?php echo date("Y-m-d:H:i:s",$first_user['registration_date']); ?></td>
				</tr>
				<tr>
					<td>Last member: <br><?php echo date("Y-m-d:H:i:s",$last_user['registration_date']); ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<!---

http://doom.tidaa.se/Demo/sources359/index.php?page=home#!/

--->