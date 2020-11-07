FROM ubuntu:20.04
WORKDIR /app
ENV DEBIAN_FRONTEND noninteractive
ENV LARAVEL_DIR /var/www/html/laravel
RUN apt-get update
RUN apt-get install curl zip unzip software-properties-common -y
RUN apt-get update
RUN apt-get install \
  nodejs \
  npm  \
  php \
  php7.4-common \
  php7.4-cli \
  php7.4-gd \
  php7.4-pgsql \
  php7.4-curl \
  php7.4-intl \
  php7.4-mbstring \
  php7.4-bcmath \
  php7.4-imap \
  php7.4-xml \
  php7.4-zip \
  -y
RUN curl -o- -L https://yarnpkg.com/install.sh | bash
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer global require laravel/installer
ENV PATH $PATH:/root/.composer/vendor/bin
COPY ./docker-entrypoint.sh .
RUN chmod +x ./docker-entrypoint.sh
ENTRYPOINT [ "/app/docker-entrypoint.sh" ]
WORKDIR ${LARAVEL_DIR}
CMD ["php", "artisan"]