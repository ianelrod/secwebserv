# Secure Web Server
Apache HTTPD Web Server with NGINX ModSecurity WAF Reverse Proxy and PostgreSQL Database

This project fulfills all business/functional requirements for contest submission and also includes WAF HTTPS/TLS, Bootstrap, logging, and an advanced web application firewall.

If I were to improve upon this design, I would do:
1. TLS all the way to the database
2. Registration system
3. Restrict upload functionality to logged in users
4. Diagnose and better control WAF false positives

This project uses HTML, CSS, JavaScript, PHP, and SQL.

### Configure

`docker compose build`
`docker compose up |& tee docker.log`

### Credentials

Website login:
secwebserv:ze$2bQeSQR8D6C

Postgres credentials:
postgres:S63^oXgRT!d&tQ

### Use

Please navigate to https://localhost/

### Remove

`docker compose down -v`
`docker image prune -a` (remove unreferenced dangling images)