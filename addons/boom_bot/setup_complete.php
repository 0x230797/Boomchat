<?php
// Script completo para configurar el bot
$config_path = "../../system/config.php";

// Verificar si el archivo existe
if (!file_exists($config_path)) {
    echo "<div style='padding: 20px; background: #f44336; color: white; margin: 20px;'>";
    echo "<h3>❌ Error de configuración</h3>";
    echo "<p>No se puede encontrar el archivo de configuración en: <code>$config_path</code></p>";
    echo "<p>Directorio actual: " . __DIR__ . "</p>";
    echo "<p>Ruta completa buscada: " . realpath($config_path) . "</p>";
    echo "</div>";
    die();
}

try {
    require_once($config_path);
} catch (Exception $e) {
    echo "<div style='padding: 20px; background: #f44336; color: white; margin: 20px;'>";
    echo "<h3>❌ Error al cargar configuración</h3>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "</div>";
    die();
}

if($user['user_rank'] >= 4){
    echo "<h2>Configuración completa del Bot</h2>";
    
    // 1. Verificar addon instalado
    $check_addon = $mysqli->query("SELECT * FROM addons WHERE name = 'boom_bot'");
    if ($check_addon->num_rows == 0) {
        $mysqli->query("INSERT INTO addons (name, status) VALUES ('boom_bot', 1)");
        echo "<p>✅ Addon boom_bot instalado correctamente.</p>";
    } else {
        echo "<p>✅ El addon boom_bot ya está instalado.</p>";
    }
    
    // 2. Verificar columnas de configuración
    $check_columns = $mysqli->query("SHOW COLUMNS FROM setting LIKE 'boom_bot_%'");
    if ($check_columns->num_rows < 6) {
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_delay int(4) NOT NULL DEFAULT '300'");
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_status int(1) NOT NULL DEFAULT '1'");
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_time int(10) NOT NULL DEFAULT '0'");
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_name varchar(20) NOT NULL DEFAULT 'Boombot'");
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_type int(1) NOT NULL DEFAULT '1'");
        $mysqli->query("ALTER TABLE setting ADD COLUMN IF NOT EXISTS boom_bot_room int(1) NOT NULL DEFAULT '1'");
        echo "<p>✅ Columnas de configuración del bot creadas.</p>";
    } else {
        echo "<p>✅ Las columnas de configuración del bot ya existen.</p>";
    }
    
    // 3. Crear tabla de datos
    $mysqli->query("CREATE TABLE IF NOT EXISTS `boom_bot_data` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `reply` varchar(1000) NOT NULL,
        `view` int(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1");
    echo "<p>✅ Tabla boom_bot_data verificada/creada.</p>";
    
    // 4. Activar el bot
    $mysqli->query("UPDATE setting SET boom_bot_status = 1, boom_bot_time = " . time());
    echo "<p>✅ Bot activado exitosamente.</p>";
    
    // 5. Agregar mensajes predeterminados si no existen
    $check_messages = $mysqli->query("SELECT * FROM boom_bot_data");
    if($check_messages->num_rows == 0){
        $default_messages = [
            "¡Hola! Soy Boombot, tu asistente virtual del chat 🤖",
            "¡Bienvenidos al chat! ¿Cómo están hoy?",
            "Recuerden respetar las reglas del chat para mantener un ambiente agradable 📝",
            "¿Sabían que pueden usar emoticonos para expresarse mejor? 😊",
            "El chat está activo las 24 horas. ¡Disfruten conversando!",
            "¡Qué buena conversación! Me encanta ver a todos participando 🎉",
            "Si tienen alguna duda, pueden contactar a los administradores",
            "¡Espero que estén pasando un buen momento en el chat! 😄",
            "Recuerden ser amables y respetuosos con todos los usuarios 💖",
            "¡El chat es más divertido cuando todos participamos! 🎊"
        ];
        
        foreach($default_messages as $message){
            $safe_message = $mysqli->real_escape_string($message);
            $mysqli->query("INSERT INTO boom_bot_data (reply) VALUES ('$safe_message')");
        }
        echo "<p>✅ Mensajes predeterminados agregados (" . count($default_messages) . " mensajes).</p>";
    } else {
        echo "<p>✅ Ya existen mensajes en el bot (" . $check_messages->num_rows . " mensajes).</p>";
    }
    
    // 6. Mostrar configuración actual
    $current_config = $mysqli->query("SELECT boom_bot_name, boom_bot_delay, boom_bot_status, boom_bot_type, boom_bot_room FROM setting")->fetch_assoc();
    echo "<h3>Configuración actual del bot:</h3>";
    echo "<ul>";
    echo "<li><strong>Nombre:</strong> " . $current_config['boom_bot_name'] . "</li>";
    echo "<li><strong>Delay:</strong> " . $current_config['boom_bot_delay'] . " segundos</li>";
    echo "<li><strong>Estado:</strong> " . ($current_config['boom_bot_status'] == 1 ? 'Activado' : 'Desactivado') . "</li>";
    echo "<li><strong>Tipo:</strong> " . ($current_config['boom_bot_type'] == 1 ? 'Secuencial' : 'Aleatorio') . "</li>";
    echo "<li><strong>Sala:</strong> " . $current_config['boom_bot_room'] . "</li>";
    echo "</ul>";
    
    echo "<p><strong>🎉 ¡Configuración del bot completada exitosamente!</strong></p>";
    echo "<p>El bot debería estar funcionando ahora. Puedes administrarlo desde el panel de addons.</p>";
    
} else {
    echo "<p>❌ No tienes permisos para configurar el bot.</p>";
}
?>
