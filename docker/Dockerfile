FROM php:5.6-apache
RUN apt-get update && apt-get upgrade -y --force-yes
RUN docker-php-ext-install mysqli
EXPOSE 80