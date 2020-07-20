FROM php:7.3.20-cli-alpine3.12

ENV GEARMAN_VERSION=2.0.3
RUN echo http://dl-cdn.alpinelinux.org/alpine/edge/main >> /etc/apk/repositories \
    && echo http://dl-cdn.alpinelinux.org/alpine/edge/community >> /etc/apk/repositories \
    && echo http://dl-cdn.alpinelinux.org/alpine/edge/testing >> /etc/apk/repositories \
    && apk update  \
    && apk add gearman-dev gearman-libs autoconf build-base \
    && set -xe \
    ; TMPDIR=$(mktemp -d) \
    ; cd $TMPDIR \
    ; curl -L https://github.com/wcgallego/pecl-gearman/archive/gearman-${GEARMAN_VERSION}.tar.gz \
    | tar xzv --strip 1 \
    ; phpize \
    ; ./configure \
    ; make -j$(nproc) \
    ; make install \
    ; cd - \
    ; rm -r $TMPDIR \
    ; docker-php-ext-enable gearman
