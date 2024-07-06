FROM php:8.2-fpm

WORKDIR /var/www/html

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    libonig-dev \
    zip

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring

# Установка Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Копирование исходного кода и выполнение команды composer install
# Настройка прав на исполнение для файла yii
COPY . /var/www/html/
RUN ls -la . && composer install --no-scripts --no-autoloader && chmod +x yii

# Настройка опций PHP
RUN echo 'memory_limit = 256M' >> /usr/local/etc/php/php.ini
RUN echo 'post_max_size = 100M' >> /usr/local/etc/php/php.ini
RUN echo 'upload_max_filesize = 100M' >> /usr/local/etc/php/php.ini

# Установка ENV PATH
ENV PATH="/var/www/html/vendor/bin:${PATH}"

# Установка Xdebug (если нужно)
RUN pecl install xdebug && docker-php-ext-enable xdebug