/*



*/
CREATE DATABASE digital360_ru;
USE DATABASE digital360_ru;

CREATE TABLE users (
    `id` INT NOT NULL,
    `login` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (  `id` )
);