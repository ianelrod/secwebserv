FROM httpd:alpine

# copy host files
COPY ./html/ /usr/local/apache2/htdocs/
COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf

# custom config
RUN rm /usr/local/apache2/htdocs/index.html

# install php dependencies
#RUN apk add build-base \
#            pkgconfig \
#            libxml2-dev \
#            sqlite-dev

# install php-fpm
# this builds php from source, so go grab a cup of coffee
# It was 5 minutes in that I regretted not using the PHP docker image
# ~10 minutes later I checked in and it finished
#RUN wget https://www.php.net/distributions/php-8.1.7.tar.gz \
#    && tar -xzf php-8.1.7.tar.gz \
#    && cd php-8.1.7 \
#    && ./configure --enable-fpm \
#    && make \
#    && make install

RUN apk add php8 \
            php8-fpm \
            php8-opcache

# example RUN for reference:
# RUN set -eux; \
#	\
#	apk add --no-cache --virtual .build-deps \
#		apr-dev \
#		apr-util-dev \
#		coreutils

# from PHP docs:
# Let's just use the defaults as shipped and start the php-fpm daemon; if your distro uses the provided init script, run /etc/init.d/php-fpm start
# Or if not, start it manually with php-fpm -y /path/to/php-fpm.conf -c /path/to/custom/php.ini
# If you don't provide php-fpm with its own php.ini file, the global php.ini will be used. Remember this when you want to include more or less extensions than the CLI or CGI binaries use, or need to alter some other values there.

# run custom httpd-foreground from httpd github to include php launch args
COPY httpd-foreground /usr/local/bin/
CMD ["httpd-foreground"]