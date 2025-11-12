FROM nginx:1.19-alpine

RUN apk add --no-cache \
    php7 \
    php7-fpm \
    php7-mysqli \
    php7-pdo \
    php7-pdo_mysql \
    php7-json \
    php7-openssl \
    php7-curl \
    php7-zlib \
    php7-xml \
    php7-phar \
    php7-intl \
    php7-dom \
    php7-xmlreader \
    php7-ctype \
    php7-session \
    php7-mbstring \
    php7-redis

RUN sed -i 's/listen = 127.0.0.1:9000/listen = 9000/g' /etc/php7/php-fpm.d/www.conf

COPY nginx-conf/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html

COPY html/ /var/www/html/

RUN chown -R nginx:nginx /var/www/html

RUN echo '#!/bin/sh' > /start.sh && \
    echo 'php-fpm7 &' >> /start.sh && \
    echo 'nginx -g "daemon off;"' >> /start.sh && \
    chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
