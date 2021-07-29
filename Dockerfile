FROM php:5.6-apache

RUN docker-php-exe-install mysqli

COPY /loja /var/www/html

EXPOSE 80
