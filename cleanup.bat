@echo off
echo Limpiando sistema La-comarca-ADMIN...

echo Eliminando caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

echo Regenerando autoloader...
composer dump-autoload

echo Regenerando caches...
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo Sistema limpio y funcionando!
pause