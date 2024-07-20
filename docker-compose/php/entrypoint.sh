#!/bin/sh

set -x

cd /var/www

composer install

if [ ! -e "./.env" ]; then
    cp .env.example .env
fi

php-fpm