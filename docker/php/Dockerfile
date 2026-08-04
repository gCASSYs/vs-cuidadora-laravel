FROM php:8.4-fpm

# Instala dependências do sistema e extensões do PHP necessárias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala o Composer dentro do container PHP
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define a pasta principal do Laravel dentro do container
WORKDIR /var/www