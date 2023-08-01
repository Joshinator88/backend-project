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

INSERT INTO `berichten` (`bericht`, `verzenderID`, `ontvangerID`) VALUES
('hey', 3, 1),
('hai', 2, 1),
('hoi', 1, 3),
('hai', 1, 2),
('how are ya', 1, 2),
('hello', 2, 3),
('whatyadoin', 3, 2);

INSERT INTO `users` (`email`, `naam`, `wachtwoord`) VALUES
('pikanto@snackbar.com', 'pikanto', 'pikanto'),
('frikandel@snackbar.com', 'frikandel', 'pikanto'),
('xxldrikandel@snackbar.com', 'xxlfrikandel', 'pikanto'),
('berenhap@snackbar.com', 'berenhap', 'pikanto');