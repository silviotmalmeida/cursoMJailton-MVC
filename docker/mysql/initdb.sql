CREATE DATABASE IF NOT EXISTS mvc_php DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE mvc_php;

CREATE TABLE IF NOT EXISTS test (id BIGINT(20) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), email VARCHAR(60), profession VARCHAR(60)) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO test(name,email,profession) VALUES ('Nome 1', 'email1@email.com', _utf8'engenheiro'), ('Nome 2', 'email2@email.com', _utf8'médico'), ('Nome 3', 'email3@email.com', _utf8'engenheiro');

