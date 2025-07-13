<?php
// Verificador de rutas y configuración
echo "<h2>Verificador de Sistema</h2>";

// Verificar ruta actual
echo "<p><strong>Directorio actual:</strong> " . __DIR__ . "</p>";
echo "<p><strong>Archivo actual:</strong> " . __FILE__ . "</p>";

// Verificar si los archivos de configuración existen
$config_files = [
    "../../system/config.php",
    "../../system/config_min.php",
    "../../system/config_lite.php"
];

echo "<h3>Archivos de configuración disponibles:</h3>";
foreach($config_files as $file){
    $full_path = __DIR__ . "/" . $file;
    if(file_exists($full_path)){
        echo "<p>✅ <strong>$file</strong> - Existe</p>";
    } else {
        echo "<p>❌ <strong>$file</strong> - No existe</p>";
    }
}

// Intentar cargar config.php
try {
    require_once("../../system/config.php");
    echo "<p>✅ <strong>config.php cargado exitosamente</strong></p>";
    
    // Verificar conexión a base de datos
    if(isset($mysqli) && $mysqli->ping()){
        echo "<p>✅ <strong>Conexión a base de datos OK</strong></p>";
    } else {
        echo "<p>❌ <strong>Problema con la conexión a base de datos</strong></p>";
    }
    
    // Verificar usuario
    if(isset($user)){
        echo "<p>✅ <strong>Usuario cargado:</strong> Rank = " . $user['user_rank'] . "</p>";
    } else {
        echo "<p>❌ <strong>Usuario no cargado</strong></p>";
    }
    
} catch(Exception $e){
    echo "<p>❌ <strong>Error al cargar config.php:</strong> " . $e->getMessage() . "</p>";
}
?>
