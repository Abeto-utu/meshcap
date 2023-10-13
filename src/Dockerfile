FROM php:8-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html

# ENV MYSQL_HOST=db MYSQL_PORT=3306

# ENV MYSQL_USER=$MYSQL_USER MYSQL_PASSWORD=$MYSQL_PASSWORD