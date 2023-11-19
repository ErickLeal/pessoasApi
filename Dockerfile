FROM php:8.3.0RC6-zts-bullseye

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libkrb5-dev \
    libc-client-dev \
    libc-client2007e-dev \
    libzip-dev \
    zip \
    unzip 

RUN pecl install mongodb

RUN docker-php-ext-enable mongodb

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html

USER $user

EXPOSE 8000