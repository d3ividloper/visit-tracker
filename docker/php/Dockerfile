FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY ta-be/composer.json ta-be/composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY ta-be/ .

RUN composer dump-autoload --optimize

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]