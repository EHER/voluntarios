FROM php:latest
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
RUN docker-php-ext-install pdo_mysql bcmath mbstring
RUN echo "date.timezone=Europe/Amsterdam" > /usr/local/etc/php/php.ini
WORKDIR /usr/src/queroSerVoluntario
EXPOSE 8000
CMD [ "make", "server" ]
