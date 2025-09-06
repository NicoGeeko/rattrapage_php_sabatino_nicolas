-- database
CREATE DATABASE notes CHARSET utf8mb4;
USE notes;

-- tables
CREATE TABLE users(
id_users INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(100) NOT NULL
)ENGINE = InnoDB;

CREATE TABLE note (
    id_note INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR(50),
    content TEXT,
    created_at DATE,
    id_users INT
)ENGINE = InnoDB;