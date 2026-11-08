FROM php:8.3-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpq-dev \
    nodejs \
    npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY src/ .

RUN composer install --no-dev --prefer-dist --no-interaction

RUN npm install

RUN npm run build

RUN php artisan migrate --force

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}