<?php
	$username = $_GET['username'];
	$channel = $_GET['channel'];
?>
<iframe src="http://irc.doom.tidaa.se:9090/?nick=<?php echo $username ?>&channels=<?php echo $channel ?>&uio=d4" style="width: 100%; height:100%; border: none;"></iframe>

<script type="text/javascript">
cheet('↑ ↑ ↓ ↓ ← → ← → b a', function () { alert('Voilà!'); });
</script>