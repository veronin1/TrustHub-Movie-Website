-- Create the TrustHub database and tables
CREATE DATABASE IF NOT EXISTS trusthub;
USE trusthub;

CREATE TABLE IF NOT EXISTS movies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  year YEAR,
  genre VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT NOT NULL,
  rating INT NOT NULL,
  review TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (movie_id) REFERENCES movies(id)
);

-- ADD A TIMESTAMP FOR REVIEWS
USE trusthub;

ALTER TABLE reviews
  ADD COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

-- MOVIES INSERT
INSERT INTO movies (title, year, genre) VALUES
('The Shawshank Redemption', 1994, 'Drama'),
('The Godfather', 1972, 'Crime'),
('The Dark Knight', 2008, 'Action'),
('The Godfather Part II', 1974, 'Crime'),
('12 Angry Men', 1957, 'Drama'),
('Schindler\'s List', 1993, 'Biography'),
('The Lord of the Rings: The Return of the King', 2003, 'Fantasy'),
('Pulp Fiction', 1994, 'Crime'),
('The Good, the Bad and the Ugly', 1966, 'Western'),
('Forrest Gump', 1994, 'Drama'),
('Fight Club', 1999, 'Drama'),
('Inception', 2010, 'Sci-Fi'),
('The Lord of the Rings: The Fellowship of the Ring', 2001, 'Fantasy'),
('Star Wars: Episode V - The Empire Strikes Back', 1980, 'Sci-Fi'),
('The Matrix', 1999, 'Sci-Fi'),
('Goodfellas', 1990, 'Crime'),
('One Flew Over the Cuckoo\'s Nest', 1975, 'Drama'),
('Se7en', 1995, 'Crime'),
('The Silence of the Lambs', 1991, 'Thriller'),
('City of God', 2002, 'Crime'),
('Saving Private Ryan', 1998, 'War'),
('Interstellar', 2014, 'Sci-Fi'),
('The Green Mile', 1999, 'Fantasy'),
('Life Is Beautiful', 1997, 'Comedy'),
('Spirited Away', 2001, 'Animation'),
('Léon: The Professional', 1994, 'Action'),
('The Usual Suspects', 1995, 'Mystery'),
('Harakiri', 1962, 'Drama'),
('The Lion King', 1994, 'Animation'),
('Back to the Future', 1985, 'Sci-Fi'),
('Terminator 2: Judgment Day', 1991, 'Action'),
('Whiplash', 2014, 'Drama'),
('Gladiator', 2000, 'Action'),
('The Prestige', 2006, 'Mystery'),
('The Departed', 2006, 'Crime'),
('Parasite', 2019, 'Thriller'),
('The Pianist', 2002, 'Biography'),
('Joker', 2019, 'Crime'),
('Alien', 1979, 'Horror'),
('The Shining', 1980, 'Horror'),
('Avengers: Infinity War', 2018, 'Action'),
('Avengers: Endgame', 2019, 'Action'),
('Django Unchained', 2012, 'Western'),
('The Wolf of Wall Street', 2013, 'Biography'),
('Oldboy', 2003, 'Thriller'),
('WALL·E', 2008, 'Animation'),
('American Beauty', 1999, 'Drama'),
('Coco', 2017, 'Animation'),
('Your Name', 2016, 'Animation'),
('Toy Story', 1995, 'Animation');

