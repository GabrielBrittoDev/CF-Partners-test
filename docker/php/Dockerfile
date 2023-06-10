FROM amazonlinux:2023.0.20230315.0

RUN yum update -y && \
    yum install -y sudo \
                   nano \
                   git \
                   htop \
                   passwd \
                   unzip \
                   zip \
                   openssl-devel \
                   gcc \
                   pkgconfig \
                   gcc-c++ \
                   wget \
                   make \
                   libzip \
                   libzip-devel

RUN yum install -y php8.1 \
                   php8.1-devel \
                   php8.1-fpm \
                   php8.1-bcmath \
                   php8.1-cli \
                   php8.1-common \
                   php8.1-intl \
                   php8.1-mbstring \
                   php8.1-mysqlnd \
                   php8.1-pdo \
                   php8.1-mysql \
                   php-pear

RUN printf "\n" | pecl install xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "NETWORKING=yes" > /etc/sysconfig/network

RUN mkdir -p /home/xdebug

COPY ./docker/php/xdebug/xdebug-debug.ini /home/xdebug/xdebug-debug.ini
COPY ./docker/php/xdebug/xdebug-default.ini /home/xdebug/xdebug-default.ini
COPY ./docker/php/xdebug/xdebug-off.ini /home/xdebug/xdebug-off.ini
COPY ./docker/php/xdebug/xdebug-profile.ini /home/xdebug/xdebug-profile.ini
COPY ./docker/php/xdebug/xdebug-trace.ini /home/xdebug/xdebug-trace.ini

ARG USER=www
ARG UID=1000
ARG GID=1000
ARG PW=docker

RUN echo "%${USER} ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

RUN useradd -m ${USER} --uid=${UID} && echo "${USER}:${PW}" | \
    chpasswd
USER ${USER}

WORKDIR /var/www

ENTRYPOINT ["bash", "/var/www/docker/php/script/entrypoint.sh"]
