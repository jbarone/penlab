CREATE DATABASE IF NOT EXISTS penlab2;
USE penlab2;

DROP TABLE If EXISTS guestbook_comments;
CREATE TABLE guestbook_comments (
    id int PRIMARY KEY AUTO_INCREMENT,
    content Text
);

INSERT INTO guestbook_comments (content)
    VALUES ('<i>Our Widgets Are The Best</i>');


DROP TABLE If EXISTS bank_users;
CREATE TABLE bank_users (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255),
    password varchar(255)
);

INSERT INTO bank_users (id, username, password)
    VALUES (1, 'rose', 'petals'),
           (2, 'bwayne', 'batman'),
           (3, 'pparker', 'webber!');


DROP TABLE If EXISTS bank_accounts;
CREATE TABLE bank_accounts (
    id int PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(255),
    lastname varchar(255),
    balance decimal(13,2)
);

INSERT INTO bank_accounts (id, firstname, lastname, balance)
    VALUES (1, 'Rose', 'Ivy', 1000.00),
           (2, 'Bruce', 'Wayne', 1000000.00),
           (3, 'Peter', 'Parker', 10000.00);
