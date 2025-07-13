<?php
// Archivo para agregar mensajes predeterminados al bot
require_once("../../../system/config.php");

if($user['user_rank'] >= 4){
    // Mensajes predeterminados para el bot
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
    
    // Verificar si ya existen mensajes
    $check_messages = $mysqli->query("SELECT * FROM boom_bot_data");
    
    if($check_messages->num_rows == 0){
        // Agregar mensajes predeterminados
        foreach($default_messages as $message){
            $safe_message = $mysqli->real_escape_string($message);
            $mysqli->query("INSERT INTO boom_bot_data (reply) VALUES ('$safe_message')");
        }
        echo "Mensajes predeterminados agregados exitosamente (" . count($default_messages) . " mensajes)";
    } else {
        echo "Ya existen mensajes en el bot (" . $check_messages->num_rows . " mensajes)";
    }
} else {
    echo "No tienes permisos para configurar el bot";
}
?>
