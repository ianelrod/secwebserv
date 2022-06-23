FROM owasp/modsecurity-crs:nginx-alpine

# generate self-signed certificate
RUN apk add openssl && \
    openssl genrsa -des3 -passout pass:x -out server.pass.key 2048 && \
    openssl rsa -passin pass:x -in server.pass.key -out /etc/nginx/conf/server.key && \
    rm server.pass.key && \
    openssl req -new -key /etc/nginx/conf/server.key -out /etc/nginx/conf/server.csr \
        -subj "/C=US/ST=Alabama/L=Huntsville/O=OrgName/OU=IT Department/CN=example.com" && \
    openssl x509 -req -days 365 -in /etc/nginx/conf/server.csr -signkey /etc/nginx/conf/server.key -out /etc/nginx/conf/server.crt

# copy host files
COPY ./custom.conf /etc/nginx/conf.d/custom.conf
#COPY server.crt /etc/nginx/conf/nginx.crt
#COPY server.key /etc/nginx/conf/nginx.key
#RUN chown nginx /etc/nginx/conf/nginx.key
#RUN chmod 0600 /etc/nginx/conf/nginx.key
#RUN chown nginx /etc/nginx/conf/nginx.key
#RUN chmod 0644 /etc/nginx/conf/nginx.crt
COPY ./RESPONSE-999-EXCLUSION-RULES-AFTER-CRS.conf /etc/modsecurity.d/owasp-crs/rules/RESPONSE-999-EXCLUSION-RULES-AFTER-CRS.conf