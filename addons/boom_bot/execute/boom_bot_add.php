<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['add_reply']) && $user['user_rank'] > 4){
	
	$reply = $mysqli->real_escape_string(trim($_POST['add_reply']));
	
	$mysqli->query("INSERT INTO `boom_bot_data` (reply) VALUES ('$reply')");
	echo 1;
	
	}
	else {
		die();
	}
?>