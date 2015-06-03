FROM php:fpm
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/php.ini
RUN docker-php-ext-install pdo_mysql
RUN usermod -u 1000 www-data
