#!/bin/sh

set -x

cd /var/www

composer install

if [ ! -e "./.env" ]; then
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
fi

php-fpm