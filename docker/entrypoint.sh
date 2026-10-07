#!/bin/bash
set -e

# Run database migrations and cache optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Seed admin or test data if needed (optional)
# php artisan db:seed --force

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
exec nginx -g "daemon off;"