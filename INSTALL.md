# 🚀 Guía de Instalación Rápida - BoomChat

## ⚡ Instalación en 5 minutos

### 📋 **Requisitos previos**
- ✅ Servidor web con PHP 7.0+
- ✅ MySQL 5.5+
- ✅ Acceso a phpMyAdmin o terminal MySQL

### 🔧 **Paso 1: Preparar Archivos**
```bash
# 1. Extraer archivos en directorio web
unzip boomchat.zip
cd boomchat/

# 2. Establecer permisos (Linux/Mac)
chmod 755 upload/
chmod 755 avatar/
chmod 755 css/themes/
```

### 🗄️ **Paso 2: Configurar Base de Datos**
```sql
-- 1. Crear base de datos
CREATE DATABASE boomchat CHARACTER SET utf8 COLLATE utf8_general_ci;

-- 2. Crear usuario (opcional)
CREATE USER 'boomchat_user'@'localhost' IDENTIFIED BY 'password_seguro';
GRANT ALL PRIVILEGES ON boomchat.* TO 'boomchat_user'@'localhost';

-- 3. Importar estructura
mysql -u root -p boomchat < boomchat.sql
```

### ⚙️ **Paso 3: Configurar Conexión**
```php
// 1. Copiar archivo de configuración
cp database.example.php system/database.php

// 2. Editar credenciales en system/database.php
$DB_HOST = 'localhost';
$DB_USER = 'boomchat_user';
$DB_PASS = 'password_seguro';
$DB_NAME = 'boomchat';
$check_install = 1;
```

### 👑 **Paso 4: Crear Administrador**
```sql
-- 1. Registrar cuenta normal en el chat
-- 2. Ejecutar en phpMyAdmin:
UPDATE users SET user_rank = 5 WHERE user_name = 'tu_usuario';
```

### 🎉 **Paso 5: ¡Listo!**
- **Chat**: `http://tudominio.com/boomchat/`
- **Admin**: Iniciar sesión > Menú > Configuración

---

## 🛠️ Configuración Opcional

### 🤖 **Activar Bot Automático**
```sql
-- El bot ya está preconfigurado, solo verificar:
SELECT boom_bot_status FROM setting; -- Debe ser 1
```

### 🎨 **Cambiar Tema**
1. Admin > Configuración > Tema por defecto
2. Seleccionar tema deseado
3. Guardar cambios

### 📱 **Configurar para Móviles**
1. Admin > Configuración > Diseño
2. Activar "Diseño responsivo"
3. Configurar "Ancho completo"

---

## 🚨 Solución de Problemas Rápidos

### ❌ **Error de conexión BD**
```bash
# Verificar credenciales
cat system/database.php

# Probar conexión
mysql -u usuario -p -h localhost base_datos
```

### ❌ **Archivos no se suben**
```bash
# Verificar permisos
ls -la upload/
chmod 755 upload/

# Verificar configuración PHP
php -m | grep gd
```

### ❌ **Panel admin no aparece**
```sql
-- Verificar rango de usuario
SELECT user_name, user_rank FROM users WHERE user_name = 'tu_usuario';

-- Elevar a administrador
UPDATE users SET user_rank = 5 WHERE user_name = 'tu_usuario';
```

### ❌ **Bot no funciona**
```sql
-- Verificar configuración
SELECT boom_bot_name, boom_bot_status, boom_bot_delay FROM setting;

-- Activar bot
UPDATE setting SET boom_bot_status = 1, boom_bot_time = 0;

-- Verificar mensajes
SELECT COUNT(*) FROM boom_bot_data;
```

---

## 📞 **¿Necesitas ayuda?**

1. **📖 Manual completo**: `documentation/manual.php`
2. **🔧 Documentación**: `README.md`
3. **🐛 Issues**: Crear issue en GitHub
4. **💬 Soporte**: Consultar documentación

---

## ⚡ **Una vez instalado:**

### **Para usuarios normales:**
- Registrarse en el chat
- Unirse a salas existentes
- Enviar mensajes públicos/privados
- Personalizar perfil y avatar

### **Para administradores:**
- Configurar bot automático
- Crear/gestionar salas
- Moderar usuarios
- Personalizar apariencia
- Generar códigos de embedding

**¡Disfruta tu nuevo chat!** 🎉
