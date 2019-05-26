FROM php:7.2-fpm-alpine

RUN apk update; \
    apk upgrade;

RUN apk add  freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

#RUN docker-php-ext-install gd2

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer global require --prefer-dist "fxp/composer-asset-plugin:~1.0"

RUN mkdir /var/log/php-fpm && ln -sf /dev/stdout /var/log/php-fpm/access.log && ln -sf /dev/stderr /var/log/php-fpm/error.log

CMD ["php-fpm"]
