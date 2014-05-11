<html>
        <div style="color: black;">
       Back to <a href='http://doom.tidaa.se/Demo/sources359/'>main site</a>
        </div>
</html>
<?php
	$id = $_GET['id'];
?>
<div style="height:25%; margin-bottom: 20px;">
<iframe src="http://doom.tidaa.se:9001/p/<?php echo $id ?>" style="width: 100%; height:82%; border: none;"></iframe>

</div>
<script type="text/javascript">
cheet('↑ ↑ ↓ ↓ ← → ← → b a', function () { alert('Voilà!'); });
</script>