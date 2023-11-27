# Use the official PHP image
FROM php:7.3-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev zip unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd pdo pdo_mysql

# Install Memcached PHP extension
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached

# Install Composer globally
RUN curl -sS https://getcomposer.org/ instaotaller | php -- --install-dir=/usr/local/bin --filename=composer
scripcr
# Copy your Laravel project files to the container
COPY . .

# Install project dependencies using Composer
RUN composer install

# Expose the port on which the application will run (default Laravel port is 8000)
EXPOSE 80

# Start PHP-FPM
CMD ["php-fpm"]
