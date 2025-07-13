@echo off
echo ================================
echo  LIMPIEZA DE ARCHIVOS BOOMCHAT
echo ================================
echo.

echo Eliminando archivos de configuracion redundantes...
del /q "system\config1.php" 2>nul
del /q "system\config_lite.php" 2>nul

echo Eliminando archivos de instalacion...
rmdir /s /q "builder" 2>nul

echo Eliminando archivos temporales de bot...
del /q "addons\boom_bot\setup_complete.php" 2>nul
del /q "addons\boom_bot\setup_manual.php" 2>nul
del /q "addons\boom_bot\verify_system.php" 2>nul
del /q "addons\boom_bot\install_bot.php" 2>nul

echo Eliminando archivos de activacion...
del /q "activate_addons.sql" 2>nul
del /q "activate_addons_simple.sql" 2>nul

echo Eliminando archivos de actualizacion...
rmdir /s /q "updater" 2>nul

echo Eliminando archivos de rescate...
rmdir /s /q "rescue" 2>nul

echo Eliminando imagenes de instalacion...
del /q "documentation\images\install_step*.jpg" 2>nul

echo.
echo ================================
echo  LIMPIEZA COMPLETADA
echo ================================
echo Los archivos innecesarios han sido eliminados.
echo El chat seguira funcionando normalmente.
pause
