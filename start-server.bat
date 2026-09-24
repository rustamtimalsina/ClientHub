@echo off
cd /d "%~dp0"
php -d variables_order=GPCS artisan serve
pause