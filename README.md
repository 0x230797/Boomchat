# 🚀 BoomChat - Sistema de Chat en Tiempo Real

![Version](https://img.shields.io/badge/version-7.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-%3E%3D7.0-brightgreen.svg)
![MySQL](https://img.shields.io/badge/MySQL-%3E%3D5.5-orange.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

## 📖 Descripción

BoomChat es un sistema de chat en tiempo real desarrollado en PHP con MySQL. Incluye características avanzadas como bots automatizados, sistema de embedding, motor de búsqueda de usuarios, y múltiples temas personalizables.

## ✨ Características Principales

### 🎯 **Funcionalidades Core**
- ✅ **Chat en tiempo real** con AJAX
- ✅ **Múltiples salas** de conversación
- ✅ **Sistema de usuarios** con rangos y permisos
- ✅ **Mensajes privados** entre usuarios
- ✅ **Sistema de amigos** e ignorados
- ✅ **Moderación avanzada** (mute, kick, ban)
- ✅ **Historial de mensajes** con búsqueda
- ✅ **Subida de archivos** e imágenes
- ✅ **Emoticonos** personalizados
- ✅ **Temas visuales** intercambiables
- ✅ **Sistema de notificaciones**
- ✅ **Responsive design** para móviles

### 🤖 **Addons Incluidos**
- 🤖 **BoomBot**: Bot automatizado con mensajes programados
- 🔗 **BoomEmbed**: Sistema de embedding para sitios web
- 🔍 **SearchEngine**: Motor de búsqueda de usuarios

### 🎨 **Temas Disponibles**
- Blue, Corporate, Default, Dark, Fancy Gold
- Gray, Lite, Lite Blue, Midnight Cherry
- Pinky Winky, Red, Adria, Glacier, Minimalistic
- Music, Sinner

## 🛠️ Requisitos del Sistema

### **Servidor Web**
- **PHP**: 7.0 o superior
- **MySQL**: 5.5 o superior
- **Apache/Nginx**: con mod_rewrite habilitado
- **Extensiones PHP**:
  - `mysqli`
  - `gd`
  - `json`
  - `session`
  - `curl` (para Facebook login)

### **Cliente**
- **Navegadores soportados**: Chrome, Firefox, Safari, Edge
- **JavaScript**: Habilitado
- **Cookies**: Habilitadas

## 📦 Instalación

### **Método 1: Instalación Automática**

1. **Descargar y extraer** los archivos en tu directorio web
2. **Crear base de datos** MySQL
3. **Importar** el archivo `boomchat.sql`:
   ```sql
   mysql -u usuario -p nombre_bd < boomchat.sql
   ```
4. **Configurar** la base de datos en `system/database.php`:
   ```php
   $DB_HOST = 'localhost';
   $DB_USER = 'tu_usuario';
   $DB_PASS = 'tu_contraseña';
   $DB_NAME = 'tu_base_datos';
   ```
5. **Establecer permisos** de escritura:
   ```bash
   chmod 755 upload/
   chmod 755 avatar/
   chmod 755 css/themes/
   ```

### **Método 2: Instalación Manual**

1. **Seguir pasos 1-2** del método automático
2. **Visitar** `http://tudominio.com/boomchat/builder/`
3. **Seguir** el asistente de instalación
4. **Completar** la configuración inicial

## ⚙️ Configuración

### **Configuración Básica**

#### **1. Administrador Principal**
- **Usuario**: Crear cuenta normal
- **Elevar privilegios**: Cambiar `user_rank` a `5` en la base de datos
- **Acceso**: Panel de administración disponible

#### **2. Configuración del Chat**
```php
// Archivo: system/config.php
$setting = [
    'title' => 'Mi Chat',
    'domain' => 'midominio.com',
    'timezone' => 'America/Mexico_City',
    'language' => 'Spanish',
    'max_message' => 300,
    'chat_history' => 20,
    'flood_delay' => 5
];
```

#### **3. Configuración de Temas**
- **Ubicación**: `css/themes/`
- **Cambiar tema**: Panel de administración > Configuración > Tema por defecto
- **Personalizar**: Modificar archivos CSS en la carpeta del tema

### **Configuración Avanzada**

#### **1. Bot Automatizado**
```php
// Configuración del bot
$bot_config = [
    'boom_bot_name' => 'MiBot',
    'boom_bot_delay' => 300,        // 5 minutos
    'boom_bot_status' => 1,         // Activo
    'boom_bot_type' => 1,           // Secuencial
    'boom_bot_room' => 1            // Sala principal
];
```

#### **2. Login con Facebook**
```php
// Archivo: system/database.php
$facebook_config = [
    'app_id' => 'tu_app_id',
    'app_secret' => 'tu_app_secret',
    'enabled' => true
];
```

#### **3. Configuración de Archivos**
```php
$file_config = [
    'max_size' => 2048,             // 2MB
    'allowed_types' => ['jpg', 'png', 'gif', 'pdf'],
    'upload_path' => 'upload/'
];
```

## 🚀 Uso

### **Para Usuarios**

#### **1. Registro y Login**
- **Registro**: Llenar formulario con email válido
- **Login**: Username y password
- **Invitados**: Acceso limitado si está habilitado

#### **2. Chat Básico**
- **Enviar mensajes**: Escribir y presionar Enter
- **Cambiar sala**: Menú superior > Salas
- **Mensajes privados**: Click en usuario > Mensaje privado
- **Emoticonos**: Botón de emoticones en el chat

#### **3. Funciones Avanzadas**
- **Perfil**: Menú > Perfil para editar información
- **Amigos**: Agregar usuarios a lista de amigos
- **Ignorados**: Bloquear usuarios molestos
- **Historial**: Ver mensajes anteriores

### **Para Administradores**

#### **1. Panel de Administración**
- **Acceso**: Menú > Configuración (solo rank 4+)
- **Usuarios**: Gestionar usuarios y permisos
- **Salas**: Crear y configurar salas
- **Configuración**: Ajustes generales del chat

#### **2. Moderación**
- **Mute**: Silenciar usuarios temporalmente
- **Kick**: Expulsar usuarios de la sala
- **Ban**: Prohibir acceso por IP
- **Filtros**: Configurar palabras prohibidas

#### **3. Addons**
- **BoomBot**: Configurar mensajes automáticos
- **BoomEmbed**: Generar códigos de embedding
- **SearchEngine**: Buscar usuarios específicos

## 🔧 Estructura del Proyecto

```
boomchat/
├── 📁 addons/                  # Addons y extensiones
│   ├── boom_bot/              # Bot automatizado
│   ├── boom_embed/            # Sistema de embedding
│   └── search_engine/         # Motor de búsqueda
├── 📁 avatar/                 # Avatares de usuarios
├── 📁 control/                # Paneles de control
├── 📁 css/                    # Estilos y temas
│   └── themes/               # Temas disponibles
├── 📁 documentation/          # Documentación
├── 📁 emoticon/              # Emoticonos
├── 📁 js/                    # Scripts JavaScript
├── 📁 sounds/                # Sonidos de notificación
├── 📁 system/                # Sistema core
├── 📁 upload/                # Archivos subidos
├── 📄 boomchat.sql          # Base de datos
├── 📄 index.php             # Página principal
├── 📄 login.php             # Sistema de login
└── 📄 README.md             # Este archivo
```

## 🎨 Personalización

### **Crear Tema Personalizado**

1. **Crear carpeta**: `css/themes/mi_tema/`
2. **Copiar archivos base**: Desde tema existente
3. **Modificar colores**: Archivo `mi_tema.css`
4. **Agregar a BD**: 
   ```sql
   INSERT INTO theme (name) VALUES ('mi_tema');
   ```

### **Personalizar Bot**

1. **Acceder**: Panel de administración > Addons > BoomBot
2. **Agregar mensajes**: Usar formulario de mensajes
3. **Configurar tiempo**: Establecer intervalo entre mensajes
4. **Modo**: Secuencial o aleatorio

### **Personalizar Embedding**

1. **Acceder**: Panel de administración > Addons > BoomEmbed
2. **Configurar**: Posición, tamaño, colores
3. **Generar código**: Copiar código HTML generado
4. **Implementar**: Pegar en sitio web de destino

## 🛡️ Seguridad

### **Medidas Implementadas**
- ✅ **Escape de datos**: Todas las entradas son sanitizadas
- ✅ **Validación**: Formularios validados en cliente y servidor
- ✅ **Sesiones seguras**: Manejo seguro de sesiones
- ✅ **Protección CSRF**: Tokens de seguridad
- ✅ **Filtro de palabras**: Sistema de moderación
- ✅ **Rate limiting**: Prevención de spam
- ✅ **Validación de archivos**: Tipos y tamaños permitidos

### **Recomendaciones**
- 🔒 **Usar HTTPS** en producción
- 🔒 **Actualizar** PHP y MySQL regularmente
- 🔒 **Configurar firewall** del servidor
- 🔒 **Backup regular** de la base de datos
- 🔒 **Monitorear logs** de acceso

## 📊 Base de Datos

### **Tablas Principales**
- `users`: Información de usuarios
- `chat`: Mensajes del chat
- `rooms`: Salas de chat
- `private`: Mensajes privados
- `setting`: Configuración del sistema
- `addons`: Addons instalados

### **Tablas del Bot**
- `boom_bot_data`: Mensajes del bot
- Columnas en `setting`: `boom_bot_*`

### **Backup y Restauración**
```bash
# Backup
mysqldump -u usuario -p boomchat > backup.sql

# Restaurar
mysql -u usuario -p boomchat < backup.sql
```

## 🔄 Actualizaciones

### **Proceso de Actualización**
1. **Backup**: Crear respaldo completo
2. **Descargar**: Nueva versión del sistema
3. **Reemplazar**: Archivos del sistema (no `system/database.php`)
4. **Ejecutar**: Scripts de actualización si existen
5. **Verificar**: Funcionamiento correcto

### **Control de Versiones**
- **Versión actual**: 7.0
- **Historial**: Disponible en `documentation/`
- **Compatibilidad**: Verificar requisitos

## 🐛 Solución de Problemas

### **Problemas Comunes**

#### **1. Error de Conexión BD**
```
Error: Connection failed
Solución: Verificar credenciales en system/database.php
```

#### **2. Archivos no se suben**
```
Error: Upload failed
Solución: Verificar permisos en carpeta upload/
```

#### **3. Bot no funciona**
```
Error: Bot inactive
Solución: Verificar configuración en tabla setting
```

#### **4. Temas no aparecen**
```
Error: Theme not found
Solución: Verificar archivos CSS en css/themes/
```

### **Logs de Error**
- **Ubicación**: `system/logs/` (si existe)
- **Activar**: Configurar `error_reporting` en PHP
- **Revisar**: Logs del servidor web

## 📞 Soporte

### **Documentación**
- **Manual**: `documentation/manual.php`
- **Guía de inicio**: `documentation/getting_started.html`
- **API**: Documentación de funciones en código

### **Contacto**
- **Desarrollador**: BoomChat Team
- **Email**: soporte@boomchat.com
- **Versión**: 7.0
- **Fecha**: 2025

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor:

1. **Fork** el proyecto
2. **Crear** rama para nueva característica
3. **Commit** cambios con mensajes descriptivos
4. **Push** a la rama
5. **Crear** Pull Request

## 🔮 Roadmap

### **Próximas Características**
- [ ] PWA (Progressive Web App)
- [ ] Notificaciones push
- [ ] Video chat
- [ ] Mensajes con formato rico
- [ ] Integraciones con APIs externas
- [ ] Dashboard de analytics

### **Mejoras Técnicas**
- [ ] Migración a PHP 8+
- [ ] Implementación de WebSockets
- [ ] Sistema de plugins
- [ ] API REST
- [ ] Containerización con Docker

---

**¡Gracias por usar BoomChat!** 🎉

Para más información, visita la documentación completa en la carpeta `documentation/`.

*Última actualización: Julio 2025*
