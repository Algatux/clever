FROM php:7.2-cli-alpine3.7

MAINTAINER Alessandro Galli <a.galli85@gmail.com>

RUN apk upgrade --update && apk add \
          autoconf file g++ gcc binutils isl libatomic libc-dev musl-dev make re2c libstdc++ libgcc binutils-libs mpc1 mpfr3 gmp libgomp \
          coreutils \
          freetype-dev \
          libltdl \
          imap-dev \
          openssl-dev \
        && docker-php-ext-configure imap --with-imap --with-imap-ssl \
        && docker-php-ext-install iconv zip bcmath imap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup -g 1000 user-dev && \
    adduser -D -u 1000 -G user-dev user-dev

USER user-dev

RUN mkdir -p /home/user-dev/project

WORKDIR /home/user-dev/project