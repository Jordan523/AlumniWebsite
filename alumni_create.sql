CREATE DATABASE alumni;
USE alumni;
CREATE TABLE accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR (30),
	email VARCHAR (30),
	grad_year INT DEFAULT 1900,
	location VARCHAR(20),
	);
	
CREATE TABLE highlights (
	post_id INT AUTO_INCREMENT PRIMARY KEY,
	image_path VARCHAR(1024),
	text BLOB
	);
	
CREATE TABLE posts_to_users (
	junction_id INT AUTO_INCREMENT PRIMARY KEY,
	FOREIGN KEY (user_id) REFERENCES alumni(user_id),
	FOREIGN KEY (post_id) REFERENCES highlights(post_id)
	);
	
