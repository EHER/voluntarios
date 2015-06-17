FROM nginx:latest
MAINTAINER Alexandre Eher <alexandre@eher.com.br>
ADD nginx.conf /etc/nginx/
RUN usermod -u 1000 www-data
EXPOSE 80
EXPOSE 443
