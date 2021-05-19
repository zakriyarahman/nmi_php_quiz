FROM php:7.4-cli-alpine
RUN docker-php-ext-install bcmath
COPY . /usr/src/quiz
WORKDIR /usr/src/quiz
CMD [ "php", "./answers.php" ]
