FROM php:8.2-fpm-alpine3.20

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www