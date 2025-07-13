<?php
	require_once("../../system/config_min.php");
	if($user['user_rank'] < 4){
		die();
	}
	$boom_bot_delay = $setting['boom_bot_delay'];
	$boom_bot_status = $setting['boom_bot_status'];
	$boom_bot_type = $setting['boom_bot_type'];
	$bot_room_select = $setting['boom_bot_room'];
?>
<div class="boom_bot_container">
	<div id="boom_bot_top">
		<h2>My bot</h2>
		<div id="boom_bot_add">
			<p>Add a bot line</p>
			<input type="text" id="boom_bot_input" class="background_box">
			<button id="add_bot_ads" class="boom_bot_full sub_button boom_bot_button hover_element">Add to bot</button>
		</div>
		<ul id="boom_bot_ul" class="background_box">
			<?php 
				$bot_list = $mysqli->query("SELECT * FROM boom_bot_data WHERE id > 0 ORDER BY id DESC");
				if ($bot_list->num_rows > 0)
				{
					while ($bot = $bot_list->fetch_assoc())
					{
						echo "<li value=\"{$bot['id']}\" class=\"top_separator boom_bot_reply\">{$bot['reply']}</li>";
					}
				}
			?>
		</ul>
		<button id="boom_bot_clear" class="setting_option_button sub_button hover_element button_left">Delete</button>
		<button id="boom_bot_clearall" class="setting_option_button sub_button hover_element button_right">Clear all</button>
		<div class="clear"></div>
	</div>
	<div id="boom_bot_bottom">
		<div id="boom_bot_setting">
			<h2>Bot settings</h2>
			<div class="option_setting bottom_separator">
				<div class="option_left">
					<label>Set bot name</label>
					<input id="boom_bot_name" placeholder="<?php echo $setting['boom_bot_name']; ?>"></input>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Bot display speed</label>
					<select id="set_bot_delay">
						<option value="60" <?= $boom_bot_delay == 60 ? 'selected="selected"' : '' ?>>1 min</option>
						<option value="120" <?= $boom_bot_delay == 120 ? 'selected="selected"' : '' ?>>2 min</option>
						<option value="180" <?= $boom_bot_delay == 180 ? 'selected="selected"' : '' ?>>3 min</option>
						<option value="240" <?= $boom_bot_delay == 240 ? 'selected="selected"' : '' ?>>4 min</option>
						<option value="300" <?= $boom_bot_delay == 300 ? 'selected="selected"' : '' ?>>5 min</option>
						<option value="600" <?= $boom_bot_delay == 600 ? 'selected="selected"' : '' ?>>10 min</option>
						<option value="900" <?= $boom_bot_delay == 900 ? 'selected="selected"' : '' ?>>15 min</option>
						<option value="1200" <?= $boom_bot_delay == 1200 ? 'selected="selected"' : '' ?>>20 min</option>
						<option value="1500" <?= $boom_bot_delay == 1500 ? 'selected="selected"' : '' ?>>25 min</option>
						<option value="1800" <?= $boom_bot_delay == 1800 ? 'selected="selected"' : '' ?>>30 min</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Activate/desactivate bot</label>
					<select id="set_bot_status">
						<option value="1" <?= $boom_bot_status == 1 ? 'selected="selected"' : '' ?>>On</option>
						<option value="0" <?= $boom_bot_status == 0 ? 'selected="selected"' : '' ?>>Off</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Show bot log data</label>
					<select id="set_bot_type">
						<option value="1" <?= $boom_bot_type == 1 ? 'selected="selected"' : '' ?>>Normal</option>
						<option value="2" <?= $boom_bot_type == 2 ? 'selected="selected"' : '' ?>>Random</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator">
				<div class="option_left">
					<label>Set bot on room</label>
					<select id="set_bot_room">
						<?php 
							$bot_rooms = $mysqli->query("SELECT * FROM rooms WHERE room_id > 0 ORDER BY room_id ASC");

								while ($boom_bot_room = $bot_rooms->fetch_assoc())
								{
									if($bot_room_select == $boom_bot_room['room_id']){
										echo "<option value=\"{$boom_bot_room['room_id']}\" selected=\"selected\" >{$boom_bot_room['room_name']}</option>";
									}
									else {
										echo "<option value=\"{$boom_bot_room['room_id']}\" >{$boom_bot_room['room_name']}</option>";
									}
								}
						?>			
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<button id="boom_bot_update" class="boom_bot_full sub_button boom_bot_button hover_element">update bot settings</button>
		</div>
	</div>
</div>