<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['add_reply']) && $user['user_rank'] >= 4){
		$reply = $mysqli->real_escape_string(trim($_POST['add_reply']));
		
		// Validar que el mensaje no esté vacío
		if(empty($reply)){
			echo 0;
			exit();
		}
		
		// Validar longitud del mensaje
		if(strlen($reply) > 1000){
			echo 0;
			exit();
		}
		
		// Verificar que el mensaje no exista ya
		$check_exists = $mysqli->query("SELECT * FROM boom_bot_data WHERE reply = '$reply'");
		if($check_exists->num_rows > 0){
			echo 0;
			exit();
		}
		
		// Insertar el mensaje
		if($mysqli->query("INSERT INTO `boom_bot_data` (reply) VALUES ('$reply')")){
			echo 1;
		} else {
			echo 0;
		}
	}
	else {
		die();
	}
?>