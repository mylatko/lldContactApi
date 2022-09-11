ARG PHP_VERSION=8.1-fpm

FROM php:${PHP_VERSION}

ARG POSTGRES_DB
ARG POSTGRES_USER
ARG POSTGRES_PASSWORD
ARG POSTGRES_HOST

ENV POSTGRES_DB=${POSTGRES_DB} POSTGRES_USER=${POSTGRES_USER} POSTGRES_PASSWORD=${POSTGRES_PASSWORD} POSTGRES_HOST=${POSTGRES_HOST}

RUN apt-get update && apt-get install -y \
        libzip-dev \
    	libpq-dev \
    	libxml2-dev \
        zip

RUN docker-php-ext-configure zip

RUN docker-php-ext-install zip \
    	opcache \
		pgsql \
		pdo \
    	opcache \
		pdo_pgsql

# Install PHP tools
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
RUN chown -R www-data:www-data /var/www
COPY --chown=www-data:www-data ./sources /var/www/

#Install project dependencies
RUN export COMPOSER_HOME=$(pwd) && composer --no-progress --prefer-dist --no-interaction install

# Expose the port nginx is reachable on
EXPOSE 9000

# Let supervisord start nginx & php-fpm
ENTRYPOINT ["/bin/bash", "-c"]
CMD ["php-fpm", "-F"]
