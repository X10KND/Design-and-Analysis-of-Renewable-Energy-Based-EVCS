<?php

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		
		
		if(isset($_GET['outv'])) {
			
			define('DB_SERVER', 'localhost');
			define('DB_USERNAME', 'root');
			define('DB_PASSWORD', '');
			define('DB_DATABASE', 'fydp');
		
			$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

			
			if ($db->connect_error) {
			  die("Connection failed: " . $db->connect_error);
			}
			
			$time = time();
			
			$stmt = $db->prepare("INSERT INTO `datatable` (`time`, `out_v`, `out_i`, `pv_out_v`, `pv_out_i`, `ac_v`, `ac_i`, `ac_p`, `ac_e`, `ac_f`, `ac_pf`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
					
			$stmt->bind_param("sssssssssss", $time, $_GET['outv'], $_GET['outi'], $_GET['pvoutv'], $_GET['pvouti'], $_GET['acv'], $_GET['aci'], $_GET['acp'], $_GET['ace'], $_GET['acf'], $_GET['acpf']);
			
			$stmt->execute();
			$result = $stmt->get_result();
			//$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
			//$count = mysqli_num_rows($result);
		}
	}
?>