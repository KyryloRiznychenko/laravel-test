#!/bin/sh

set -x

cd /var/www

composer install

if [ ! -e "./app/database/database.sqlite" ]; then
    touch database/database.sqlite
fi

if [ ! -e "./.env" ]; then
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
fi

php-fpm