<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['ads_delete']) && $user['user_rank'] > 4){
	
	$ads_delete = $mysqli->real_escape_string(trim($_POST['ads_delete']));
	
	$mysqli->query("DELETE FROM `boom_bot_data` WHERE id = $ads_delete");
	echo 1;
	
	}
	else {
		die();
	}
?>