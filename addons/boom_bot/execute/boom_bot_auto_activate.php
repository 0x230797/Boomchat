<?php
// Archivo para activar el bot automáticamente
require_once("../../../system/config.php");

// Verificar si el usuario es administrador
if($user['user_rank'] >= 4){
    // Verificar si el bot está desactivado
    if($setting['boom_bot_status'] == 0){
        // Activar el bot automáticamente
        $mysqli->query("UPDATE setting SET boom_bot_status = 1, boom_bot_time = $time");
        echo "Bot activado automáticamente";
    } else {
        echo "Bot ya está activo";
    }
} else {
    echo "No tienes permisos para activar el bot";
}
?>
