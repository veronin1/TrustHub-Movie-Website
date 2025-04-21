CREATE DATABASE trusthub;
USE trusthub;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year YEAR,
    genre VARCHAR(50)
);