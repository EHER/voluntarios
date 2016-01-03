FROM php:5-fpm
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN usermod -u 1000 www-data
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/conf.d/date.ini
RUN echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'opcache.validate_timestamps=0' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'opcache.fast_shutdown=1' >> /usr/local/etc/php/conf.d/opcache.conf
