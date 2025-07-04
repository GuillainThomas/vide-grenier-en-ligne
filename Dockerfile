FROM php:8.3-apache

# Install PHP extensions needed for the project
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Install composer from the official composer image
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy custom Apache configuration and enable modules
RUN a2enmod rewrite
COPY ["docker/000-default.conf", "/etc/apache2/sites-available/000-default.conf"]

# Set the working directory and copy project files
WORKDIR /var/www/html
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure file permissions for uploads
RUN chown -R www-data:www-data /var/www/html
# RUN chown -R www-data:www-data /var/www/html/public/storage

EXPOSE 80
CMD ["apache2-foreground"]
