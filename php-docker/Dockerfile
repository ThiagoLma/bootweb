FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mysqli zip