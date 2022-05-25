FROM php:7.3-fpm

RUN apt update && apt install -y libzip-dev zip mc nano libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-install pdo_mysql mysqli zip
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN cd ~ \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]
