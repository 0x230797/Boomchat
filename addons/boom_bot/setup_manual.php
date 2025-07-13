<?php
// Configuración alternativa para el bot
echo "<h2>Configuración Manual del Bot</h2>";

// Intentar diferentes rutas de configuración
$config_paths = [
    "../../system/config.php",
    "../../system/config_min.php",
    "../../../system/config.php",
    "../../config.php"
];

$config_loaded = false;

foreach($config_paths as $path){
    if(file_exists($path)){
        echo "<p>Intentando cargar: $path</p>";
        try {
            require_once($path);
            echo "<p>✅ Configuración cargada exitosamente desde: $path</p>";
            $config_loaded = true;
            break;
        } catch (Exception $e) {
            echo "<p>❌ Error con $path: " . $e->getMessage() . "</p>";
        }
    }
}

if(!$config_loaded){
    echo "<div style='background: #f44336; color: white; padding: 20px; margin: 20px;'>";
    echo "<h3>No se pudo cargar la configuración</h3>";
    echo "<p>Verifica que:</p>";
    echo "<ul>";
    echo "<li>El archivo config.php existe en la carpeta system</li>";
    echo "<li>Los permisos de archivo son correctos</li>";
    echo "<li>La conexión a la base de datos está configurada</li>";
    echo "</ul>";
    echo "</div>";
    die();
}

// Continuar con la configuración del bot...
if($user['user_rank'] >= 4){
    echo "<div style='background: #4CAF50; color: white; padding: 15px; margin: 20px;'>";
    echo "<h3>✅ Configuración del Bot Iniciada</h3>";
    echo "<p>Usuario: " . $user['username'] . " (Rank: " . $user['user_rank'] . ")</p>";
    echo "</div>";
    
    // Ejecutar comandos SQL de configuración
    echo "<h3>Instalando Bot...</h3>";
    
    // 1. Verificar/crear addon
    $check_addon = $mysqli->query("SELECT * FROM addons WHERE name = 'boom_bot'");
    if ($check_addon->num_rows == 0) {
        if($mysqli->query("INSERT INTO addons (name, status) VALUES ('boom_bot', 1)")){
            echo "<p>✅ Addon instalado</p>";
        } else {
            echo "<p>❌ Error al instalar addon: " . $mysqli->error . "</p>";
        }
    } else {
        echo "<p>✅ Addon ya existe</p>";
    }
    
    // 2. Verificar/crear columnas
    $columns = [
        "boom_bot_delay" => "int(4) NOT NULL DEFAULT '300'",
        "boom_bot_status" => "int(1) NOT NULL DEFAULT '1'",
        "boom_bot_time" => "int(10) NOT NULL DEFAULT '0'",
        "boom_bot_name" => "varchar(20) NOT NULL DEFAULT 'Boombot'",
        "boom_bot_type" => "int(1) NOT NULL DEFAULT '1'",
        "boom_bot_room" => "int(1) NOT NULL DEFAULT '1'"
    ];
    
    foreach($columns as $column => $definition){
        $check_column = $mysqli->query("SHOW COLUMNS FROM setting LIKE '$column'");
        if($check_column->num_rows == 0){
            if($mysqli->query("ALTER TABLE setting ADD COLUMN $column $definition")){
                echo "<p>✅ Columna $column creada</p>";
            } else {
                echo "<p>❌ Error creando columna $column: " . $mysqli->error . "</p>";
            }
        } else {
            echo "<p>✅ Columna $column ya existe</p>";
        }
    }
    
    // 3. Crear tabla de datos
    $create_table = "CREATE TABLE IF NOT EXISTS `boom_bot_data` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `reply` varchar(1000) NOT NULL,
        `view` int(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1";
    
    if($mysqli->query($create_table)){
        echo "<p>✅ Tabla boom_bot_data creada</p>";
    } else {
        echo "<p>❌ Error creando tabla: " . $mysqli->error . "</p>";
    }
    
    // 4. Activar bot
    if($mysqli->query("UPDATE setting SET boom_bot_status = 1, boom_bot_time = " . time())){
        echo "<p>✅ Bot activado</p>";
    } else {
        echo "<p>❌ Error activando bot: " . $mysqli->error . "</p>";
    }
    
    echo "<div style='background: #4CAF50; color: white; padding: 15px; margin: 20px;'>";
    echo "<h3>🎉 ¡Bot configurado exitosamente!</h3>";
    echo "<p>Ahora puedes acceder al panel del bot desde el chat.</p>";
    echo "</div>";
    
} else {
    echo "<div style='background: #f44336; color: white; padding: 15px; margin: 20px;'>";
    echo "<h3>❌ Sin permisos</h3>";
    echo "<p>Necesitas ser administrador para configurar el bot.</p>";
    echo "</div>";
}
?>
