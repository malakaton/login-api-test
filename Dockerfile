FROM php:7.4

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . ./
RUN composer install --no-interaction -o

