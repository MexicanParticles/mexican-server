FROM php:7.4-alpine

RUN apk update && \
    apk add autoconf build-base && \
    pecl install redis xdebug && \
    docker-php-ext-enable redis xdebug

ENV TZ Asia/Tokyo
RUN apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
    echo ${TZ} > /etc/timezone && \
    apk del tzdata

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN mkdir -p vendor/bin
ENV PATH /app/www/vendor/bin:${PATH}
