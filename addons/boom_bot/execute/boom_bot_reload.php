<?php
	require_once("../../../system/config_min.php");
	if($user['user_access'] == 4 && $user['user_rank'] >= 4){
		$bot_list = $mysqli->query("SELECT * FROM boom_bot_data WHERE id > 0 ORDER BY id DESC");
		if ($bot_list->num_rows > 0)
		{
			while ($bot = $bot_list->fetch_assoc())
			{
				echo "<li value=\"{$bot['id']}\" class=\"top_separator boom_bot_reply\">{$bot['reply']}</li>";
			}
		}
	}
	else {
		die();
	}
?>