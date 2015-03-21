/*



*/

#CREATE DATABASE digital360_ru;
USE digital360_ru;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    image_id INT,
    PRIMARY KEY (id)
);

CREATE TABLE images(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    image blob NOT NULL,
    PRIMARY KEY (id)
);
