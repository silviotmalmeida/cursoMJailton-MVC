CREATE DATABASE IF NOT EXISTS mvc_php;

USE mvc_php;

CREATE TABLE IF NOT EXISTS categories (id BIGINT(20) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50) NOT NULL);

INSERT INTO categories(name) VALUES ('Categoria 1'), ('Categoria 2'), ('Categoria 3');

