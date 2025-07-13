<?php
	require_once("../../system/config_min.php");
	
	// Verificar permisos del usuario
	if($user['user_rank'] < 4){
		echo "<div style='padding: 20px; text-align: center;'>";
		echo "<h3>❌ Acceso denegado</h3>";
		echo "<p>No tienes permisos para acceder al panel del bot.</p>";
		echo "<p>Se requiere rango de administrador (nivel 4 o superior).</p>";
		echo "</div>";
		die();
	}
	
	// Obtener configuración actual del bot
	$boom_bot_delay = $setting['boom_bot_delay'];
	$boom_bot_status = $setting['boom_bot_status'];
	$boom_bot_type = $setting['boom_bot_type'];
	$bot_room_select = $setting['boom_bot_room'];
	
	// Verificar si el addon está instalado
	$check_addon = $mysqli->query("SELECT * FROM addons WHERE name = 'boom_bot'");
	if ($check_addon->num_rows == 0) {
		echo "<div style='padding: 20px; text-align: center;'>";
		echo "<h3>⚠️ Bot no instalado</h3>";
		echo "<p>El addon del bot no está instalado correctamente.</p>";
		echo "<p><a href='setup_complete.php' style='background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Instalar Bot</a></p>";
		echo "</div>";
		die();
	}
?>
<div class="boom_bot_container">
	<!-- Indicador de estado del bot -->
	<div style="background: <?php echo $boom_bot_status == 1 ? '#4CAF50' : '#f44336'; ?>; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
		<strong>Estado del Bot: <?php echo $boom_bot_status == 1 ? '🟢 ACTIVO' : '🔴 INACTIVO'; ?></strong>
		<?php if($boom_bot_status == 1): ?>
			<br><small>Próximo mensaje en: <?php echo $boom_bot_delay; ?> segundos</small>
		<?php endif; ?>
	</div>
	
	<div id="boom_bot_top">
		<h2>Mi Bot - Administración</h2>
		<div id="boom_bot_add">
			<p>Agregar nuevo mensaje al bot</p>
			<input type="text" id="boom_bot_input" class="background_box" placeholder="Escribe un mensaje para el bot..." maxlength="1000">
			<button id="add_bot_ads" class="boom_bot_full sub_button boom_bot_button hover_element">Agregar mensaje</button>
		</div>
		<div style="margin: 10px 0;">
			<p><strong>Mensajes actuales del bot:</strong></p>
		</div>
		<ul id="boom_bot_ul" class="background_box">
			<?php 
				$bot_list = $mysqli->query("SELECT * FROM boom_bot_data WHERE id > 0 ORDER BY id DESC");
				if ($bot_list->num_rows > 0)
				{
					while ($bot = $bot_list->fetch_assoc())
					{
						$status_indicator = $bot['view'] == 1 ? '✅' : '⏳';
						echo "<li value=\"{$bot['id']}\" class=\"top_separator boom_bot_reply\">{$status_indicator} {$bot['reply']}</li>";
					}
				} else {
					echo "<li style='text-align: center; color: #666;'>No hay mensajes configurados. Agrega algunos mensajes para que el bot pueda funcionar.</li>";
				}
			?>
		</ul>
		<button id="boom_bot_clear" class="setting_option_button sub_button hover_element button_left">Eliminar seleccionado</button>
		<button id="boom_bot_clearall" class="setting_option_button sub_button hover_element button_right">Limpiar todos</button>
		<div class="clear"></div>
	</div>
	<div id="boom_bot_bottom">
		<div id="boom_bot_setting">
			<h2>Configuración del Bot</h2>
			<div class="option_setting bottom_separator">
				<div class="option_left">
					<label>Nombre del bot</label>
					<input id="boom_bot_name" placeholder="<?php echo $setting['boom_bot_name']; ?>" value="<?php echo $setting['boom_bot_name']; ?>">
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Frecuencia de mensajes</label>
					<select id="set_bot_delay">
						<option value="60" <?= $boom_bot_delay == 60 ? 'selected="selected"' : '' ?>>1 minuto</option>
						<option value="120" <?= $boom_bot_delay == 120 ? 'selected="selected"' : '' ?>>2 minutos</option>
						<option value="180" <?= $boom_bot_delay == 180 ? 'selected="selected"' : '' ?>>3 minutos</option>
						<option value="240" <?= $boom_bot_delay == 240 ? 'selected="selected"' : '' ?>>4 minutos</option>
						<option value="300" <?= $boom_bot_delay == 300 ? 'selected="selected"' : '' ?>>5 minutos</option>
						<option value="600" <?= $boom_bot_delay == 600 ? 'selected="selected"' : '' ?>>10 minutos</option>
						<option value="900" <?= $boom_bot_delay == 900 ? 'selected="selected"' : '' ?>>15 minutos</option>
						<option value="1200" <?= $boom_bot_delay == 1200 ? 'selected="selected"' : '' ?>>20 minutos</option>
						<option value="1500" <?= $boom_bot_delay == 1500 ? 'selected="selected"' : '' ?>>25 minutos</option>
						<option value="1800" <?= $boom_bot_delay == 1800 ? 'selected="selected"' : '' ?>>30 minutos</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Estado del bot</label>
					<select id="set_bot_status">
						<option value="1" <?= $boom_bot_status == 1 ? 'selected="selected"' : '' ?>>🟢 Activado</option>
						<option value="0" <?= $boom_bot_status == 0 ? 'selected="selected"' : '' ?>>🔴 Desactivado</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator bottom_separator">
				<div class="option_left">
					<label>Modo de mensajes</label>
					<select id="set_bot_type">
						<option value="1" <?= $boom_bot_type == 1 ? 'selected="selected"' : '' ?>>📝 Secuencial (en orden)</option>
						<option value="2" <?= $boom_bot_type == 2 ? 'selected="selected"' : '' ?>>🎲 Aleatorio</option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="option_setting top_separator">
				<div class="option_left">
					<label>Sala donde funcionará el bot</label>
					<select id="set_bot_room">
						<?php 
							$bot_rooms = $mysqli->query("SELECT * FROM rooms WHERE room_id > 0 ORDER BY room_id ASC");
							if($bot_rooms->num_rows > 0){
								while ($boom_bot_room = $bot_rooms->fetch_assoc())
								{
									$selected = $bot_room_select == $boom_bot_room['room_id'] ? 'selected="selected"' : '';
									echo "<option value=\"{$boom_bot_room['room_id']}\" {$selected}>{$boom_bot_room['room_name']}</option>";
								}
							} else {
								echo "<option value=\"1\">Sala Principal</option>";
							}
						?>			
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<button id="boom_bot_update" class="boom_bot_full sub_button boom_bot_button hover_element">💾 Guardar configuración</button>
		</div>
	</div>
</div>