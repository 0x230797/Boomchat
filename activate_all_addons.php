<?php
// Script para activar todos los addons disponibles
$config_path = "system/config.php";

// Verificar si el archivo existe
if (!file_exists($config_path)) {
    echo "<div style='padding: 20px; background: #f44336; color: white; margin: 20px;'>";
    echo "<h3>❌ Error de configuración</h3>";
    echo "<p>No se puede encontrar el archivo de configuración en: <code>$config_path</code></p>";
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
    echo "<div style='padding: 20px; background: #2196F3; color: white; margin: 20px;'>";
    echo "<h2>🚀 Activación de Addons</h2>";
    echo "<p>Configurando todos los addons disponibles...</p>";
    echo "</div>";
    
    // Lista de addons disponibles
    $addons = [
        'boom_bot' => 'Bot de chat automático',
        'boom_embed' => 'Sistema de embedding del chat',
        'search_engine' => 'Motor de búsqueda de usuarios'
    ];
    
    echo "<div style='padding: 20px; margin: 20px; background: #f5f5f5;'>";
    echo "<h3>📋 Addons disponibles:</h3>";
    echo "<ul>";
    
    foreach($addons as $addon_name => $addon_description){
        echo "<li><strong>{$addon_name}</strong>: {$addon_description}</li>";
    }
    
    echo "</ul>";
    echo "</div>";
    
    // Verificar y activar cada addon
    foreach($addons as $addon_name => $addon_description){
        echo "<div style='padding: 15px; margin: 10px 20px; background: white; border-left: 4px solid #4CAF50;'>";
        echo "<h4>🔧 Configurando: {$addon_name}</h4>";
        
        // Verificar si el addon ya existe
        $check_addon = $mysqli->query("SELECT * FROM addons WHERE name = '$addon_name'");
        
        if($check_addon->num_rows == 0){
            // Insertar el addon
            if($mysqli->query("INSERT INTO addons (name, status) VALUES ('$addon_name', 1)")){
                echo "<p>✅ Addon instalado exitosamente</p>";
            } else {
                echo "<p>❌ Error al instalar addon: " . $mysqli->error . "</p>";
            }
        } else {
            // Actualizar el estado a activo
            if($mysqli->query("UPDATE addons SET status = 1 WHERE name = '$addon_name'")){
                echo "<p>✅ Addon ya existe y está activo</p>";
            } else {
                echo "<p>❌ Error al actualizar addon: " . $mysqli->error . "</p>";
            }
        }
        
        // Verificar si el addon tiene archivos necesarios
        $addon_path = "../../addons/{$addon_name}/{$addon_name}.php";
        if(file_exists($addon_path)){
            echo "<p>✅ Archivo principal encontrado</p>";
        } else {
            echo "<p>⚠️ Archivo principal no encontrado: {$addon_path}</p>";
        }
        
        // Verificar icono
        $icon_path = "../../addons/{$addon_name}/images/{$addon_name}.png";
        if(file_exists($icon_path)){
            echo "<p>✅ Icono encontrado</p>";
        } else {
            echo "<p>⚠️ Icono no encontrado: {$icon_path}</p>";
        }
        
        echo "<p><strong>Descripción:</strong> {$addon_description}</p>";
        echo "</div>";
    }
    
    // Configuración especial para boom_bot si no está configurado
    $check_bot_config = $mysqli->query("SHOW COLUMNS FROM setting LIKE 'boom_bot_%'");
    if($check_bot_config->num_rows == 0){
        echo "<div style='padding: 15px; margin: 10px 20px; background: #fff3cd; border-left: 4px solid #ffc107;'>";
        echo "<h4>🤖 Configuración especial para boom_bot</h4>";
        
        $bot_columns = [
            "boom_bot_delay" => "int(4) NOT NULL DEFAULT '300'",
            "boom_bot_status" => "int(1) NOT NULL DEFAULT '1'",
            "boom_bot_time" => "int(10) NOT NULL DEFAULT '0'",
            "boom_bot_name" => "varchar(20) NOT NULL DEFAULT 'Boombot'",
            "boom_bot_type" => "int(1) NOT NULL DEFAULT '1'",
            "boom_bot_room" => "int(1) NOT NULL DEFAULT '1'"
        ];
        
        foreach($bot_columns as $column => $definition){
            if($mysqli->query("ALTER TABLE setting ADD COLUMN $column $definition")){
                echo "<p>✅ Columna {$column} agregada</p>";
            } else {
                echo "<p>❌ Error con columna {$column}: " . $mysqli->error . "</p>";
            }
        }
        
        // Crear tabla de datos del bot
        $create_bot_table = "CREATE TABLE IF NOT EXISTS `boom_bot_data` (
            `id` int(10) NOT NULL AUTO_INCREMENT,
            `reply` varchar(1000) NOT NULL,
            `view` int(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1";
        
        if($mysqli->query($create_bot_table)){
            echo "<p>✅ Tabla boom_bot_data creada</p>";
        } else {
            echo "<p>❌ Error creando tabla del bot: " . $mysqli->error . "</p>";
        }
        
        echo "</div>";
    }
    
    // Mostrar resumen final
    echo "<div style='padding: 20px; background: #4CAF50; color: white; margin: 20px;'>";
    echo "<h3>🎉 ¡Configuración completada!</h3>";
    echo "<p>Todos los addons han sido activados exitosamente.</p>";
    echo "</div>";
    
    // Mostrar cómo acceder a los addons
    echo "<div style='padding: 20px; background: #e3f2fd; margin: 20px;'>";
    echo "<h3>📖 Cómo acceder a los addons:</h3>";
    echo "<ol>";
    echo "<li><strong>Inicia sesión</strong> como administrador en el chat</li>";
    echo "<li><strong>Busca el icono de \"+\"</strong> en la parte inferior del chat</li>";
    echo "<li><strong>Haz clic en el icono \"+\"</strong> para abrir el panel de addons</li>";
    echo "<li><strong>Selecciona el addon</strong> que deseas usar:</li>";
    echo "<ul>";
    echo "<li>🤖 <strong>boom_bot</strong>: Configurar mensajes automáticos</li>";
    echo "<li>🔗 <strong>boom_embed</strong>: Generar código para embedding</li>";
    echo "<li>🔍 <strong>search_engine</strong>: Buscar usuarios en el chat</li>";
    echo "</ul>";
    echo "</ol>";
    echo "</div>";
    
    // Mostrar addons activos
    $active_addons = $mysqli->query("SELECT * FROM addons WHERE status = 1");
    echo "<div style='padding: 20px; background: #f8f9fa; margin: 20px;'>";
    echo "<h3>📊 Addons activos:</h3>";
    echo "<ul>";
    while($addon = $active_addons->fetch_assoc()){
        $addon_desc = isset($addons[$addon['name']]) ? $addons[$addon['name']] : 'Addon personalizado';
        echo "<li>✅ <strong>{$addon['name']}</strong> - {$addon_desc}</li>";
    }
    echo "</ul>";
    echo "</div>";
    
} else {
    echo "<div style='padding: 20px; background: #f44336; color: white; margin: 20px;'>";
    echo "<h3>❌ Sin permisos</h3>";
    echo "<p>Necesitas ser administrador (rango 4 o superior) para activar addons.</p>";
    echo "<p>Tu rango actual: {$user['user_rank']}</p>";
    echo "</div>";
}
?>
