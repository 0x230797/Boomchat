<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['bot_name']) && isset($_POST['bot_delay']) && isset($_POST['bot_status']) && isset($_POST['bot_type']) && isset($_POST['bot_room']) && $user['user_rank'] >= 4){
		$bot_name = $mysqli->real_escape_string(trim($_POST['bot_name']));
		$bot_status = intval($_POST['bot_status']);
		$bot_delay = intval($_POST['bot_delay']);
		$bot_type = intval($_POST['bot_type']);
		$bot_room = intval($_POST['bot_room']);
		
		// Validar valores
		if($bot_name == ''){
			$bot_name = $setting['boom_bot_name'];
		}
		
		// Validar que el delay esté en un rango válido
		if($bot_delay < 60 || $bot_delay > 1800){
			$bot_delay = 300; // Default 5 minutos
		}
		
		// Validar status (0 o 1)
		if($bot_status != 0 && $bot_status != 1){
			$bot_status = 0;
		}
		
		// Validar type (1 o 2)
		if($bot_type != 1 && $bot_type != 2){
			$bot_type = 1;
		}
		
		// Actualizar configuración
		$update_query = "UPDATE `setting` SET 
			`boom_bot_name` = '$bot_name', 
			`boom_bot_delay` = $bot_delay, 
			`boom_bot_status` = $bot_status, 
			`boom_bot_type` = $bot_type, 
			`boom_bot_room` = $bot_room";
		
		if($mysqli->query($update_query)){
			echo 1;
		} else {
			echo 0;
		}
	}
	else {
		die();
	}
?>