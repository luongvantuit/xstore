FROM composer:2.4.4 as COMPOSER

WORKDIR /app/composer

COPY ./composer.json ./composer.json

RUN composer install

FROM php:8.1.3-fpm

WORKDIR /app

COPY ./public ./public
COPY ./src ./src
COPY --from=COMPOSER /app/composer/vendor ./vendor

EXPOSE 80

ENV TZ=UTC

CMD php -S 0.0.0.0:80 -t ./public
