<?php
	if($user['user_rank'] > 4 && $user['user_access'] == 4){
					
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_delay");
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_status");
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_time");
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_name");
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_type");
	$mysqli->query("ALTER TABLE setting DROP COLUMN boom_bot_room");
	$mysqli->query("DROP TABLE boom_bot_data");
	
	}

?>