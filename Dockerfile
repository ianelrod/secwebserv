FROM httpd:alpine

COPY ./html/ /usr/local/apache2/htdocs/
COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf

RUN wget https://www.php.net/distributions/php-8.1.7.tar.gz \
    && tar -xzf php-8.1.7.tar.gz \
    && cd ../php-8.1.7 \
    && ./configure --enable-fpm \
    && make \
    && make install

# This provides us with a new binary, called php-fpm, and a default configuration file called php-fpm.conf is installed in /etc.
# The defaults in this file should be okay to get you started, but be aware that your distribution may have altered it, or changed its location.

# RUN set -eux; \
#	\
#	apk add --no-cache --virtual .build-deps \
#		apr-dev \
#		apr-util-dev \
#		coreutils

RUN /etc/init.d/php-fpm start
# OR RUN php-fpm -y /path/to/php-fpm.conf -c /path/to/custom/php.ini

# Let's just use the defaults as shipped and start the php-fpm daemon; if your distro uses the provided init script, run /etc/init.d/php-fpm start
# Or if not, start it manually with php-fpm -y /path/to/php-fpm.conf -c /path/to/custom/php.ini
# If you don't provide php-fpm with its own php.ini file, the global php.ini will be used. Remember this when you want to include more or less extensions than the CLI or CGI binaries use, or need to alter some other values there.