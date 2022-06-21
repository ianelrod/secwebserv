FROM postgres:alpine

# copy host files
COPY ./postgres.conf /var/lib/postgresql/data/postgresql.conf
COPY ./pg_hba.conf /var/lib/postgresql/data/pg_hba.conf
COPY ./postgres.sql /docker-entrypoint-initdb.d/