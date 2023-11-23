FROM php:8-cli

RUN apt-get update && apt-get install -y curl git zip libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer