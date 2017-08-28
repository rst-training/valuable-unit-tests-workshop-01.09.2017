FROM php:7.1.8-cli

RUN apt-get update && apt-get install -y \
    curl \
    git \
    libicu-dev \
    zlib1g-dev \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip intl mbstring

RUN curl -Ss https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer

WORKDIR /app
CMD [ "tail", "-f", "/dev/null" ]
