@echo off
echo ====================================
echo    LA COMARCA ADMIN - SETUP
echo ====================================
echo.

echo [1/8] Clonando repositorio...
git clone https://github.com/KeynaCaFu/La-comarca-ADMIN.git
cd La-comarca-ADMIN

echo.
echo [2/8] Instalando dependencias...
composer install

echo.
echo [3/8] Generando clave de aplicacion...
php artisan key:generate

echo.
echo [4/8] Limpiando cache...
php artisan cache:clear
php artisan config:clear

echo.
echo [5/8] Configurando cache...
php artisan config:cache

echo.
echo [6/8] Verificando Laravel...
php artisan --version

echo.
echo ====================================
echo     CONFIGURACION COMPLETADA
echo ====================================
echo.
echo IMPORTANTE:
echo 1. Inicia XAMPP (Apache y MySQL)
echo 2. Crea la base de datos 'bdsage' en phpMyAdmin
echo 3. Ejecuta: php artisan serve
echo 4. Ve a: http://localhost:8000
echo.
echo ====================================
pause