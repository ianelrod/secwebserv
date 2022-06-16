FROM owasp/modsecurity-crs:nginx-alpine

# copy host files
COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./RESPONSE-999-EXCLUSION-RULES-AFTER-CRS.conf /etc/modsecurity.d/owasp-crs/rules/RESPONSE-999-EXCLUSION-RULES-AFTER-CRS.conf