<?php


function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function array_sanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

?>