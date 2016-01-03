FROM php:latest
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN echo 'date.timezone="GMT"' >> /usr/local/etc/php/php.ini
RUN apt-get update && apt-get install -y zlib1g-dev git \
    && docker-php-ext-install zip
COPY app /var/www/symfony/app
COPY bin /var/www/symfony/bin
COPY src /var/www/symfony/src
COPY web /var/www/symfony/web
COPY Makefile /var/www/symfony/
COPY bower.json /var/www/symfony/
COPY composer.json /var/www/symfony/
COPY composer.lock /var/www/symfony/
COPY package.json /var/www/symfony/
ENV SYMFONY__MAILGUN__KEY invalid-value
ENV SYMFONY__MAILGUN__DOMAIN invalid-value
ENV SYMFONY__FRAMEWORK__LOCALE invalid-value
ENV SYMFONY__FRAMEWORK__SECRET invalid-value
ENV SYMFONY__CONTACT__EMAIL invalid-value
WORKDIR /var/www/symfony
ENTRYPOINT ["make", "perms", "config", "install", "database", "logs"]
