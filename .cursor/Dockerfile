FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive

# System packages, PHP 8.3 runtime + extensions required by the app
# (sqlite for the default DB, gd for intervention/image + medialibrary,
# mbstring/xml/curl/bcmath/intl/zip for Laravel, mysql for optional MySQL use).
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        gnupg \
        unzip \
        php8.3-cli \
        php8.3-common \
        php8.3-mbstring \
        php8.3-xml \
        php8.3-curl \
        php8.3-sqlite3 \
        php8.3-mysql \
        php8.3-gd \
        php8.3-bcmath \
        php8.3-intl \
        php8.3-zip \
    && rm -rf /var/lib/apt/lists/*

# Composer (pinned installer verified against the official checksum endpoint).
RUN curl -fsSL https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -f /tmp/composer-setup.php \
    && composer --version

# Node.js 22 (matches the toolchain used to build the Vite/Tailwind assets).
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/* \
    && node --version \
    && npm --version

# The base Ubuntu 24.04 image already ships an unprivileged `ubuntu` user (uid 1000).
USER ubuntu
WORKDIR /home/ubuntu
