FROM php:latest
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install -y zlib1g-dev git \
    && docker-php-ext-install zip pdo_mysql

VOLUME /var/www/symfony
COPY . /var/www/symfony
WORKDIR /var/www/symfony

ENTRYPOINT ["make", "perms", "database", "logs"]
