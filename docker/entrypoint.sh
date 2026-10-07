#!/bin/bash
set -e

# Default to port 80 if PORT environment variable is not provided
PORT="${PORT:-80}"

# Substitute port in nginx config
sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/http.d/default.conf

# Run database migrations and cache optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
exec nginx -g "daemon off;"