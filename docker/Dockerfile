FROM php:8.2-cli-alpine3.17

ARG DOCKER_USER_ID
ARG DOCKER_GROUP_ID

RUN if ! getent group "${DOCKER_GROUP_ID}" > /dev/null; \
    then addgroup -S -g "${DOCKER_GROUP_ID}" devs; \
    fi \
    && if ! getent passwd "${DOCKER_USER_ID}" > /dev/null; \
      then adduser -S -u "${DOCKER_USER_ID}" -G "$(getent group "${DOCKER_GROUP_ID}" | awk -F: '{printf $1}')" dev; \
    fi \
    && apk add --no-cache git libxml2-dev openssh-client \
    && apk add --no-cache --virtual .build-deps autoconf g++ make \
    # xdebug \
    && apk add --update linux-headers \
    && pecl install xdebug-3.2.2 \
    && docker-php-ext-enable xdebug \
    # composer
    && curl --output composer-setup.php https://getcomposer.org/installer \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php \
    # xdebug command
    && curl --location --output /usr/local/bin/xdebug https://github.com/julienfalque/xdebug/releases/download/v2.0.0/xdebug \
    && chmod +x /usr/local/bin/xdebug \
    # clean up
    && apk del .build-deps

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN ln -s /var/app/notifier/vendor/bin/pest /usr/local/bin/pest
WORKDIR /var/app/notifier
EXPOSE 9003