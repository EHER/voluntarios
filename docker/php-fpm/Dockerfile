FROM php:fpm
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN usermod -u 1000 www-data
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/conf.d/date.ini
RUN echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'opcache.validate_timestamps=0' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'opcache.fast_shutdown=1' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'catch_workers_output=yes' >> /usr/local/etc/php/conf.d/opcache.conf
RUN echo 'php_flag[display_errors]=off' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_flag[display_startup_errors]=off' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_flag[log_errors]=on' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_admin_value[error_log]=on' >> /usr/local/etc/php-fpm.conf
RUN echo 'php_admin_value[display_errors]=stderr' >> /usr/local/etc/php-fpm.conf
