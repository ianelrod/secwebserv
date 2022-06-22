CREATE EXTENSION pgcrypto;

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

INSERT INTO users (username, password) VALUES (
    'secwebserv',
    crypt('ze$2bQeSQR8D6C', gen_salt('bf'))
);