/*



*/

#CREATE DATABASE digital360_ru;
USE digital360_ru;

CREATE TABLE users (
    id INT NOT NULL,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id)
);
