<?php
	
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'fydp');

	$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	
	if ($db->connect_error) {
	  die("Connection failed: " . $db->connect_error);
	}
	
	$time = time();
	
	$stmt = $db->prepare("SELECT * FROM datatable ORDER BY time DESC LIMIT 1");
	
	$stmt->execute();
	$result = $stmt->get_result();
	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	
	header("Content-Type: application/json");
	echo json_encode($row[0]);
?>