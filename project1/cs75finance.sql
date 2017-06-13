CREATE DATABASE cs75finance;

USE cs75finance;

CREATE TABLE users(
    id BIGINT NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    first_name VARCHAR(50),
    surname VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(8,2),
    PRIMARY KEY (id),
    UNIQUE (email)
);

CREATE TABLE stocks(
    id BIGINT NOT NULL AUTO_INCREMENT,
    name VARCHAR(15),
    symbol VARCHAR(15),
    shares INT,
    purchase_price DECIMAL(8,2),
    user_id BIGINT,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE transactions(
    id BIGINT NOT NULL AUTO_INCREMENT,
    user_id BIGINT,
    transaction VARCHAR(4),
    time DATETIME,
    symbol VARCHAR(15),
    shares INT,
    price DECIMAL(8,2),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE INDEX email_index
ON users(email);

CREATE INDEX password_index
ON users(password);

CREATE INDEX balance_index
ON users(balance);