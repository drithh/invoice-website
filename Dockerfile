# Used for prod build.
FROM php:8.1-fpm as php

# Set environment variables
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_ENABLE_CLI=0
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0
ENV PHP_OPCACHE_REVALIDATE_FREQ=0

# Install dependencies.
RUN apt-get update && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev nginx libonig-dev

# Install PHP extensions.
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath curl opcache mbstring pgsql pdo_pgsql

# Copy composer executable.
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

# Copy configuration files.
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# Set working directory to ...
WORKDIR /app

# Copy composer files first for better layer caching
COPY --chown=www-data:www-data composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader

# Copy files from current folder to container current folder (set in workdir).
COPY --chown=www-data:www-data . .

# Make entrypoint script executable
RUN chmod +x docker/entrypoint.sh

# Create laravel caching folders.
RUN mkdir -p ./storage/framework
RUN mkdir -p ./storage/framework/{cache, testing, sessions, views}
RUN mkdir -p ./storage/framework/bootstrap
RUN mkdir -p ./storage/framework/bootstrap/cache

# Clear bootstrap cache to remove any dev package references
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php || true

# Adjust user permission & group.
RUN usermod --uid 1000 www-data
RUN groupmod --gid 1000  www-data
EXPOSE 8080
# Run the entrypoint file.
ENTRYPOINT [ "docker/entrypoint.sh" ]