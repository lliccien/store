FROM php:7.4.9-fpm-alpine3.12

RUN apk add --no-cache \
        freetype-dev \
        gettext-dev \
        icu-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libxml2-dev \
        libxpm-dev \
        libxslt-dev \
        libzip-dev \
        postgresql-dev \
        unzip \
    && apk add --no-cache --update --virtual build-deps \
        autoconf \
        automake \
        g++ \
        gcc \
        make \
        wget \
        curl \
    && pecl install apcu-5.1.18 \
    && pecl install redis-5.2.1 \
    && pecl install xdebug-2.9.4 \
    && docker-php-ext-configure gd \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        calendar \
        exif \
        gettext \
        gd \
        opcache \
        sockets \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        xsl \
        zip \
    && docker-php-ext-enable \
        apcu \
        opcache \
        redis \
        xdebug \
    && wget https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 \
    && chmod +x mhsendmail_linux_amd64 \
    && mv mhsendmail_linux_amd64 /usr/local/bin/mhsendmail \
    && apk del --no-cache build-deps \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

RUN apk add bash \
     git \
    && wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony && \
    chmod +x /usr/local/bin/symfony


WORKDIR /usr/share/nginx/html
