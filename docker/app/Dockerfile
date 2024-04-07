FROM php:8.0.2-apache

ENV APP_ROOT /var/www/app.loc

WORKDIR $APP_ROOT

ADD configs/apache2/sites-available/app.loc.conf    /etc/apache2/sites-available

RUN rm -r /var/www/html

RUN cd /etc/apache2/mods-enabled && \
    a2enmod rewrite && \
    a2enmod headers

RUN a2ensite app.loc.conf


RUN apt-get update && apt-get install -y \
    mc \
    telnet \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libgeoip-dev \
    libicu-dev \
    libbz2-dev \
    libmemcached-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    default-mysql-client \
    g++\
    libxml2-dev\
    cron \
    libmagickwand-dev --no-install-recommends  \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install soap
RUN docker-php-ext-install simplexml
RUN apt install -y curl

RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1

RUN docker-php-ext-install \
    bz2 \
    intl \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    zip \
    mysqli \
    gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install imagick

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*

# install imagick
# Version is not officially released https://pecl.php.net/get/imagick but following works for PHP 8
RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
    docker-php-ext-install imagick;

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer