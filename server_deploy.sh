#!/bin/sh
set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'Redzone is being (quickly!) updated. Please try again in a minute.') || true
    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # Migrate database
    # php artisan migrate --force

    # Clear cache
    php artisan optimize

    # Install npm dependencies
    npm install && npm run build

# Exit maintenance mode
php artisan up

echo "Application deployed!"
