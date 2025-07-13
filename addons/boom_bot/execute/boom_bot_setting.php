<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['bot_name']) && isset($_POST['bot_delay']) && isset($_POST['bot_status'])&& isset($_POST['bot_type']) && $user['user_rank'] > 4){
		$bot_name = $mysqli->real_escape_string(trim($_POST['bot_name']));
		$bot_status = $mysqli->real_escape_string(trim($_POST['bot_status']));
		$bot_delay = $mysqli->real_escape_string(trim($_POST['bot_delay']));
		$bot_type = $mysqli->real_escape_string(trim($_POST['bot_type']));
		$bot_room = $mysqli->real_escape_string(trim($_POST['bot_room']));
		
		if($bot_name == ''){
			$bot_name = $setting['boom_bot_name'];
		}
		$mysqli->query("UPDATE `setting` SET `boom_bot_name` = '$bot_name', `boom_bot_delay` = $bot_delay, `boom_bot_status` = $bot_status, `boom_bot_type` = $bot_type, `boom_bot_room` = $bot_room");
		echo 1;
	}
	else {
		die();
	}
?>