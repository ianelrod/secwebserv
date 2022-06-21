# Secure Web Server
HTTPD with NGINX ModSecurity WAF

### Configure

1. Create directory "uploads" under "httpd"

2. `docker compose build`

3. `docker compose up`

isset($_POST['login'])&&!empty($_POST['login'])

### Credentials

Website login:
secwebserv:ze$2bQeSQR8D6C

Postgres credentials:
postgres:S63^oXgRT!d&tQ

### Use

https://localhost/index.php

### Remove

1. `docker compose down -v`

2. `docker image prune -a` (remove unreferenced dangling images)