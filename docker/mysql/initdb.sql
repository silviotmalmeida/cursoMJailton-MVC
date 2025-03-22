CREATE DATABASE IF NOT EXISTS mvc_php;

USE mvc_php;

CREATE TABLE IF NOT EXISTS test (id BIGINT(20) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), email VARCHAR(60));

INSERT INTO test(name,email) VALUES ('Nome 1', 'email1@email.com'), ('Nome 2', 'email2@email.com'), ('Nome 3', 'email3@email.com');

