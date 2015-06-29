FROM php:fpm
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN apt-get update && apt-get install -y libsqlite3-0 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite
RUN usermod -u 1000 www-data
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/conf.d/date.ini
RUN echo 'catch_workers_output = yes' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_flag[display_errors] = off' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_flag[display_startup_errors] = off' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_flag[log_errors] = on' >> /usr/local/etc/php-fpm.conf
