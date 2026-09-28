FROM php:8.4-cli-alpine
COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache git unzip && install-php-extensions zip intl mbstring
WORKDIR /var/www/html
