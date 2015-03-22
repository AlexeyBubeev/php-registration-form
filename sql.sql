CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    p_hash VARCHAR(100) NOT NULL,
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

CREATE UNIQUE INDEX p_hash ON users(p_hash);
CREATE UNIQUE INDEX id ON users(id);
CREATE INDEX login_password ON users(login, password);