<?php
// Script para instalar el addon boom_bot
require_once("../../system/config.php");

// Verificar si el addon ya está instalado
$check_addon = $mysqli->query("SELECT * FROM addons WHERE name = 'boom_bot'");

if ($check_addon->num_rows == 0) {
    // Instalar el addon
    $mysqli->query("INSERT INTO addons (name, status) VALUES ('boom_bot', 1)");
    echo "Addon boom_bot instalado correctamente.<br>";
} else {
    echo "El addon boom_bot ya está instalado.<br>";
}

// Verificar si las columnas de configuración existen
$check_columns = $mysqli->query("SHOW COLUMNS FROM setting LIKE 'boom_bot_%'");
if ($check_columns->num_rows == 0) {
    // Crear las columnas necesarias
    $mysqli->query("ALTER TABLE setting ADD boom_bot_delay int(4) NOT NULL DEFAULT '300'");
    $mysqli->query("ALTER TABLE setting ADD boom_bot_status int(1) NOT NULL DEFAULT '0'");
    $mysqli->query("ALTER TABLE setting ADD boom_bot_time int(10) NOT NULL DEFAULT '0'");
    $mysqli->query("ALTER TABLE setting ADD boom_bot_name varchar(20) NOT NULL DEFAULT 'Boombot'");
    $mysqli->query("ALTER TABLE setting ADD boom_bot_type int(1) NOT NULL DEFAULT '1'");
    $mysqli->query("ALTER TABLE setting ADD boom_bot_room int(1) NOT NULL DEFAULT '1'");
    echo "Columnas de configuración del bot creadas.<br>";
} else {
    echo "Las columnas de configuración del bot ya existen.<br>";
}

// Crear la tabla de datos del bot si no existe
$mysqli->query("CREATE TABLE IF NOT EXISTS `boom_bot_data` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `reply` varchar(1000) NOT NULL,
    `view` int(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1");

echo "Tabla boom_bot_data verificada/creada.<br>";
echo "Instalación del bot completada exitosamente!";
?>
