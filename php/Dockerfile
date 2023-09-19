FROM php:8-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html
#No se si poner el copy

# ENV MYSQL_HOST=db MYSQL_PORT=3306

# ENV MYSQL_USER=$MYSQL_USER MYSQL_PASSWORD=$MYSQL_PASSWORD

# EXPOSE 80