FROM php:7.4.19-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY /loja /var/www/html

EXPOSE 80
