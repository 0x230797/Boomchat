# Configuración de Base de Datos para BoomChat
# Renombrar este archivo a database.php y configurar con tus datos

<?php
    // ====================================
    // CONFIGURACIÓN DE BASE DE DATOS
    // ====================================
    
    // Servidor de base de datos (generalmente localhost)
    $DB_HOST = 'localhost';
    
    // Usuario de MySQL
    $DB_USER = 'tu_usuario_mysql';
    
    // Contraseña de MySQL
    $DB_PASS = 'tu_contraseña_mysql';
    
    // Nombre de la base de datos
    $DB_NAME = 'tu_base_datos_boomchat';
    
    // ====================================
    // CONFIGURACIÓN DE INSTALACIÓN
    // ====================================
    
    // Marcar como instalado (cambiar a 1 después de la instalación)
    $check_install = 1;
    
    // ====================================
    // CONFIGURACIÓN DE FACEBOOK (OPCIONAL)
    // ====================================
    
    // Si quieres habilitar login con Facebook, configura estos valores:
    // 1. Crear app en https://developers.facebook.com/
    // 2. Obtener App ID y App Secret
    // 3. Configurar URL de callback
    
    $facebook_app_id = 'tu_facebook_app_id';
    $facebook_app_secret = 'tu_facebook_app_secret';
    
    // ====================================
    // CONFIGURACIÓN DE ZONA HORARIA
    // ====================================
    
    // Configurar según tu ubicación
    // Ejemplos:
    // America/Mexico_City
    // America/New_York
    // Europe/Madrid
    // Asia/Tokyo
    date_default_timezone_set('America/Mexico_City');
    
    // ====================================
    // CONFIGURACIÓN DE ARCHIVOS
    // ====================================
    
    // Tamaño máximo de archivos en MB
    $max_file_size = 2;
    
    // Tipos de archivo permitidos
    $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
    
    // ====================================
    // CONFIGURACIÓN DE SEGURIDAD
    // ====================================
    
    // Clave secreta para sesiones (cambiar por una única)
    $secret_key = 'cambiar_por_clave_unica_y_secreta_123456789';
    
    // Configuración de cookies
    $cookie_domain = '.tudominio.com'; // Agregar punto al inicio para subdominios
    $cookie_secure = false; // Cambiar a true si usas HTTPS
    
    // ====================================
    // CONFIGURACIÓN DE EMAIL (OPCIONAL)
    // ====================================
    
    // Para recuperación de contraseñas y notificaciones
    $smtp_config = [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => 'tucorreo@gmail.com',
        'password' => 'tu_contraseña_app',
        'encryption' => 'tls',
        'from_email' => 'noreply@tudominio.com',
        'from_name' => 'BoomChat'
    ];
    
    // ====================================
    // CONFIGURACIÓN DE DESARROLLO
    // ====================================
    
    // Mostrar errores PHP (desactivar en producción)
    $show_errors = true;
    
    if ($show_errors) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }
    
    // ====================================
    // NO MODIFICAR DEBAJO DE ESTA LÍNEA
    // ====================================
?>

<!-- 
INSTRUCCIONES DE CONFIGURACIÓN:

1. RENOMBRAR ARCHIVO:
   - Renombrar "database.example.php" a "database.php"

2. CONFIGURAR BASE DE DATOS:
   - Crear base de datos en MySQL/phpMyAdmin
   - Importar archivo "boomchat.sql"
   - Configurar credenciales arriba

3. ESTABLECER PERMISOS:
   - upload/ (lectura/escritura)
   - avatar/ (lectura/escritura)
   - css/themes/ (lectura/escritura)

4. CONFIGURAR ADMINISTRADOR:
   - Registrar cuenta normal en el chat
   - En phpMyAdmin, cambiar "user_rank" a 5 en tabla "users"

5. ACCESO:
   - Chat: http://tudominio.com/boomchat/
   - Admin: Menú > Configuración (después de configurar admin)

6. OPCIONAL - FACEBOOK LOGIN:
   - Crear app en Facebook Developers
   - Configurar App ID y App Secret arriba
   - Activar en panel de administración

7. SEGURIDAD EN PRODUCCIÓN:
   - Usar HTTPS
   - Cambiar $show_errors a false
   - Configurar $cookie_secure a true
   - Usar contraseñas fuertes
   - Configurar firewall del servidor

¿PROBLEMAS?
- Verificar permisos de archivos
- Revisar logs del servidor web
- Comprobar versiones de PHP/MySQL
- Consultar documentation/manual.php
-->
