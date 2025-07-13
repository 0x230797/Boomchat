<?php
	require_once("../../../system/config.php");
	$post_time = date("H:i", $time);
	$bot_name = $setting['boom_bot_name'];
	$bot_room = $setting['boom_bot_room'];
	$bot_time = $setting['boom_bot_time'] + $setting['boom_bot_delay'];
	if($user['user_access'] == 4 && $setting['boom_bot_status'] == 1){

		if($time > $bot_time){
		$ckbdata = $mysqli->query("SELECT * FROM `boom_bot_data` WHERE `id`> 0");
		if($ckbdata->num_rows > 0){
			if($setting['boom_bot_type'] == 1){
				$findbotdata = $mysqli->query("SELECT * FROM `boom_bot_data` WHERE `view` != 1 ORDER BY `id` ASC LIMIT 1");
				$result = $findbotdata->num_rows;
				if($result > 0){
					$prepare = $findbotdata->fetch_array(MYSQLI_BOTH);
					$this_ads_bot = $prepare['id'];
					$mysqli->query("UPDATE boom_bot_data SET view = 1 WHERE id = $this_ads_bot");
					$botsay =  addslashes($prepare['reply']);
					$mysqli->query("UPDATE setting SET boom_bot_time = $time");
					$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$bot_name', '$botsay', $bot_room, 'modo', 'public', 'boom_bot.png')");
				}
				else {
					$mysqli->query("UPDATE boom_bot_data SET view = 0 WHERE id > 0");
					echo 2;
				}
			}
			else {
				$findbotdata = $mysqli->query("SELECT * FROM `boom_bot_data`");
				$result = $findbotdata->num_rows;
				if($result > 0){
					$prepare = $mysqli->query("SELECT reply FROM boom_bot_data ORDER BY RAND() LIMIT 1");
					$prepare_result = $prepare->fetch_array(MYSQLI_BOTH);
					$botsay = addslashes($prepare_result['reply']);
					$mysqli->query("UPDATE setting SET boom_bot_time = $time");
					$mysqli->query("INSERT INTO `chat` (post_date, post_time, user_id, post_user, post_message, post_roomid, post_color, type, avatar) VALUES ('$time', '$post_time', '999999', '$bot_name', '$botsay', $bot_room, 'modo', 'public', 'boom_bot.png')");
				}
				else {
					die();
				}
			}
		}
		else {
			die();
		}
	}
	else {
		die();
	}
	
	}
	else {
		die();
	}
?>