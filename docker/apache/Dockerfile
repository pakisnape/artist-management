FROM php:7.4-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/artistmanagement

CMD composer install ; \
    bin/console doctrine:migrations:migrate --no-interaction;

EXPOSE 8050
