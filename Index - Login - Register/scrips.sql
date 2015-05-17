/* Run this in phpmyadmin */

CREATE TABLE users (
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(100),
	password VARCHAR(100),
	PRIMARY KEY(id)
)