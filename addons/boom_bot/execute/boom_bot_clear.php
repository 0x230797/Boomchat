<?php
	require_once("../../../system/config_min.php");
	
	if(isset($_POST['ads_clear']) && $user['user_rank'] > 4){
		$ads_clear = $mysqli->real_escape_string(trim($_POST['ads_clear']));
		if($ads_clear == 1){
			$mysqli->query("TRUNCATE TABLE boom_bot_data");
			echo 1;
		}
		else {
			die();
		}
	}
	else {
		die();
	}
?>