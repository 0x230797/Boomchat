<?php
	require_once("../../../system/config.php");
	
	// Verificar permisos y configuración
	if($user['user_access'] != 4 || $setting['boom_bot_status'] != 1){
		die();
	}
	
	$post_time = date("H:i", $time);
	$bot_name = $setting['boom_bot_name'];
	$bot_room = $setting['boom_bot_room'];
	$bot_time = $setting['boom_bot_time'] + $setting['boom_bot_delay'];
	
	// Verificar si es tiempo de que el bot hable
	if($time > $bot_time){
		$ckbdata = $mysqli->query("SELECT * FROM `boom_bot_data` WHERE `id` > 0");
		if($ckbdata->num_rows > 0){
			
			if($setting['boom_bot_type'] == 1){
				// Modo secuencial
				$findbotdata = $mysqli->query("SELECT * FROM `boom_bot_data` WHERE `view` != 1 ORDER BY `id` ASC LIMIT 1");
				$result = $findbotdata->num_rows;
				
				if($result > 0){
					$prepare = $findbotdata->fetch_array(MYSQLI_BOTH);
					$this_ads_bot = $prepare['id'];
					$botsay = $mysqli->real_escape_string($prepare['reply']);
					
					// Marcar como visto
					$mysqli->query("UPDATE boom_bot_data SET view = 1 WHERE id = $this_ads_bot");
					
					// Actualizar tiempo del bot
					$mysqli->query("UPDATE setting SET boom_bot_time = $time");
					
					// Insertar mensaje en el chat
					$insert_query = "INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) 
						VALUES ('$time', '$post_time', '999999', '$bot_name', '$botsay', $bot_room, 'modo', 'public', 'boom_bot.png')";
					
					if($mysqli->query($insert_query)){
						echo 1; // Mensaje enviado exitosamente
					} else {
						echo 0; // Error al enviar mensaje
					}
				} else {
					// Reiniciar el ciclo
					$mysqli->query("UPDATE boom_bot_data SET view = 0 WHERE id > 0");
					echo 2; // Ciclo reiniciado
				}
			} else {
				// Modo aleatorio
				$findbotdata = $mysqli->query("SELECT reply FROM boom_bot_data ORDER BY RAND() LIMIT 1");
				$result = $findbotdata->num_rows;
				
				if($result > 0){
					$prepare_result = $findbotdata->fetch_array(MYSQLI_BOTH);
					$botsay = $mysqli->real_escape_string($prepare_result['reply']);
					
					// Actualizar tiempo del bot
					$mysqli->query("UPDATE setting SET boom_bot_time = $time");
					
					// Insertar mensaje en el chat
					$insert_query = "INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) 
						VALUES ('$time', '$post_time', '999999', '$bot_name', '$botsay', $bot_room, 'modo', 'public', 'boom_bot.png')";
					
					if($mysqli->query($insert_query)){
						echo 1; // Mensaje enviado exitosamente
					} else {
						echo 0; // Error al enviar mensaje
					}
				} else {
					die();
				}
			}
		} else {
			die();
		}
	} else {
		echo 3; // No es tiempo aún
	}
?>