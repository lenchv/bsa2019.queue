FROM php:7.3.6-fpm-stretch

ARG UID=1000
ARG GID=1000

RUN docker-php-ext-install pdo_mysql
RUN addgroup --gid=$GID appuser \
    && useradd -r -u $UID -g appuser appuser

USER appuser