FROM php:8.1.3-fpm as php

RUN docker-php-ext-install mysqli

FROM nginx:latest

COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/php

COPY ./public /var/www/php/public

COPY ./src /var/www/php/src

COPY ./autoload.php /var/www/php/autoload.php

EXPOSE 80