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
            php8-opcache \
            php8-fileinfo \
            php8-session \
            php8-pgsql \
            acl

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

# copy custom httpd-foreground that includes php launch args
COPY httpd-foreground /usr/local/bin/

# copy custom php configuration
COPY php.ini /etc/php8/php.ini
COPY www.conf /etc/php8/php-fpm.d/www.conf


RUN mkdir /var/lib/php8/session \
    # remove default permissions
    && chmod -R 0000 /usr/local/apache2/htdocs \
    && chmod -R -st /usr/local/apache2/htdocs \
    && chmod -R 0000 /var/lib/php8/session \
    && chmod -R -st /var/lib/php8/session \
    # set ownership
    && chown -R www-data:www-data /var/lib/php8/session \
    && chown -R www-data:www-data /usr/local/apache2/htdocs \
    # change permissions for session folder
    && setfacl -Rm u::rwX /var/lib/php8/session \
    # && setfacl -dm m::r /var/lib/php8/session \
    # change permissions for web folder
    && setfacl -Rm u::rX /usr/local/apache2/htdocs \
    # change permissions for uploads folder
    && setfacl -Rm u::rwX /usr/local/apache2/htdocs/uploads
    # && setfacl -dm m::r /usr/local/apache2/htdocs/uploads
    

CMD ["httpd-foreground"]