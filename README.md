# Secure Web Server
Apache HTTPD Web Server with NGINX ModSecurity WAF Reverse Proxy and PostgreSQL Database

This project fulfills all business/functional requirements for contest submission and also includes WAF HTTPS/TLS, Bootstrap, logging, and an advanced web application firewall.

If I were to improve upon this design, I would do:
1. TLS all the way to the database
2. Registration system
3. Restrict upload functionality to logged in users
4. Diagnose and better control WAF false positives
5. Store file upload and session management in Postgres

This project uses HTML, CSS, JavaScript, PHP, and SQL.

### Configure

1. `docker compose build`
2. `docker compose up |& tee docker.log`

### Credentials

Website login:
secwebserv:ze$2bQeSQR8D6C

Postgres credentials:
postgres:S63^oXgRT!d&tQ

### Use

Navigate to https://localhost/

### Remove

1. `docker compose down -v`
2. `docker image prune -a` (remove unreferenced dangling images)
