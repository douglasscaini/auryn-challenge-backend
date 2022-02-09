FROM php:7.4-apache

RUN apt-get update && apt-get install -y libmagickwand-dev wget git unzip vim --no-install-recommends \ 
    && rm -rf /var/lib/apt/lists/* 
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

# Install composer
RUN wget https://getcomposer.org/composer.phar -O /usr/bin/composer
RUN chmod +x /usr/bin/composer

# Sets symfony web folder as document_root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

