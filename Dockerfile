FROM php:7.3-apache

WORKDIR /var/www/html

COPY . .

ENV DEFAULT_DB_HOST="db" RABBIT_MQ_HOST="rabbitmq" REDIS_HOST="redis"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt update && a2enmod rewrite && service apache2 restart && docker-php-ext-install pdo_mysql