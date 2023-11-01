FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update \
    && apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev libcurl4-openssl-dev \
    pkg-config libssl-dev libzip-dev zlib1g-dev \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev  \
    unzip  \
    tzdata \
    cron

ENV TZ=Europe/Belgrade

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install opcache

RUN docker-php-ext-install zip

RUN docker-php-ext-configure gd --enable-gd --prefix=/usr --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install exif

COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/conf.d/php.ini /usr/local/etc/php/conf.d/php.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Add user for laravel application
RUN chown -R 997:997 /var/www
# Change current user to www-data
USER 997
