COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
 
RUN apt-get update \
    && apt-get install -y unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*