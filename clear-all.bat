@echo off
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan clear-compiled
echo Toda la caché ha sido limpiada.
pause