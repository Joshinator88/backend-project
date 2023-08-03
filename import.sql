DROP DATABASE IF EXISTS `chats`;

CREATE DATABASE `chats`;

USE `chats`;

CREATE TABLE `users` (
    ID MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    naam VARCHAR(100) NOT NULL,
    wachtwoord VARCHAR(100) NOT NULL
);

CREATE TABLE `berichten` (
    ID MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    bericht TEXT,
    verzenderID MEDIUMINT NOT NULL,
    ontvangerID MEDIUMINT NOT NULL
);

CREATE TABLE `vrienden` (
    ID MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    vriendOneID MEDIUMINT NOT NULL,
    vriendTwoID MEDIUMINT NOT NULL
);

CREATE TABLE `friendRequests` (
    ID MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    requestorID MEDIUMINT NOT NULL,
    recieverID MEDIUMINT NOT NULL
);

INSERT INTO `users` (`email`, `naam`, `wachtwoord`) VALUES
('pikanto@snackbar.com', 'pikanto', 'pikanto'),
('frikandel@snackbar.com', 'frikandel', 'pikanto'),
('xxlfrikandel@snackbar.com', 'xxlfrikandel', 'pikanto'),
('berenhap@snackbar.com', 'berenhap', 'pikanto');