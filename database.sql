CREATE DATABASE trusthub;
USE trusthub;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year YEAR,
    genre VARCHAR(50)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    rating INT NOT NULL,
    review TEXT NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);