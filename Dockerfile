FROM owasp/modsecurity-crs:nginx

COPY ./public-html/ /usr/share/nginx/html
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./modsecurity.conf /etc/nginx/modsecurity.conf