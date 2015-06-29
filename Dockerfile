FROM php:latest
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install -y zlib1g-dev libsqlite3-0 libsqlite3-dev git \
    && docker-php-ext-install zip pdo_sqlite
VOLUME /var/www/symfony
VOLUME /var/www/symfony/database
COPY app /var/www/symfony/app
COPY bin /var/www/symfony/bin
COPY src /var/www/symfony/src
COPY vendor /var/www/symfony/vendor
COPY web /var/www/symfony/web
COPY Makefile /var/www/symfony/
COPY bower.json /var/www/symfony/
COPY composer.json /var/www/symfony/
COPY composer.lock /var/www/symfony/
COPY package.json /var/www/symfony/
WORKDIR /var/www/symfony
ENTRYPOINT ["make", "perms", "database", "logs"]
