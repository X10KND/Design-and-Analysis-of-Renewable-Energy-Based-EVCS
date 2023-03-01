<?php
	$json = file_get_contents("http://worldtimeapi.org/api/timezone/Asia/Dhaka");
	$obj = json_decode($json);
	
	var_dump($obj);
	
?>