FROM php:8.1-fpm-alpine3.17

LABEL Maintainer <nbarreto@uniandes.edu.co>

# Add Repositories
RUN rm -f /etc/apk/repositories &&\
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.13/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.13/community" >> /etc/apk/repositories

ENV DOCKERIZE_VERSION 0.6.1

# Install dockerize so we can wait for containers to be ready
RUN curl -s -f -L -o /tmp/dockerize.tar.gz https://github.com/jwilder/dockerize/releases/download/v$DOCKERIZE_VERSION/dockerize-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf /tmp/dockerize.tar.gz \
    && rm /tmp/dockerize.tar.gz

# Add Build Dependencies
RUN set -ex; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        autoconf \
        bzip2-dev \
        gmp-dev \
        libjpeg-turbo-dev \
        libmcrypt-dev \
        libmemcached-dev \
        libpng-dev \
        libzip-dev \
        openldap-dev \
        pcre-dev \
        postgresql-dev \
    ; \
    \
    docker-php-ext-configure gd --with-jpeg; \
    docker-php-ext-configure ldap; \
    docker-php-ext-install -j "$(nproc)" \
        bz2 \
        gd \
        gmp \
        ldap \
        mysqli \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        zip \
        ;

RUN set -xe; \
    \
    echo "---> Installing Packages Dependencies"; \
    \
    apk update; \
    \
    apk add --update --no-cache \
        git \
        sudo \
        curl \
        wget \
        fcgi \
        make \
        bash \
        tini \
        supervisor \
        mysql-client \
        openssh-client \
        bash-completion \
        dos2unix \
    rm -rf /tmp/* /var/cache/apk/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

VOLUME /var/www/html/

COPY app_laravel.tar app_laravel.tar

RUN mkdir /usr/src/laravel && tar -xf app_laravel.tar -C /usr/src/laravel && chown -R www-data:www-data /usr/src/laravel

RUN rm -rf /usr/local/etc/php-fpm.d/www.conf ;\
    rm -rf /usr/local/etc/php/php.ini ;

COPY docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
RUN chmod -Rf 777 /var/www/html/
COPY makedb.php /makedb.php
COPY db.sql /db.sql
COPY php_conf.ini /usr/local/etc/php/php.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
RUN dos2unix /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]