FROM php:8.1-cli

RUN docker-php-ext-install mysqli

COPY ./local /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./index.php" ]