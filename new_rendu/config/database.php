<?php

//AllowNoPassword :  

// sur mac mettre le port sinon error : QLSTATE[HY000] [2002] No such file or directory
$DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
// $DB_HOST = 'localhost';
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'camagru';
$DB_TABLE = [
	'users (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(250) NOT NULL,
		email VARCHAR(250) NOT NULL,
		password VARCHAR(250) NOT NULL,
		confirmation_token VARCHAR(60) NULL DEFAULT NULL,
		confirm_at DATETIME NULL DEFAULT NULL,
		reset_token VARCHAR(60) NULL DEFAULT NULL,
		reset_at DATETIME NULL DEFAULT NULL,
		remember_token VARCHAR(250) NULL DEFAULT NULL)',
	'photo (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT UNSIGNED NOT NULL,
		url VARCHAR(250) NOT NULL,
		url_mini VARCHAR(250) NOT NULL,
		description VARCHAR(250) NOT NULL,
		created_at DATETIME NULL DEFAULT NULL,
		like_count INT UNSIGNED NOT NULL
	)',
	'vote (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id INT UNSIGNED NOT NULL,
		photo_id INT UNSIGNED NOT NULL
		)',
	'comment (
		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,
		photo_id INT NOT NULL,
		comment VARCHAR(300) NOT NULL,
		created_at DATETIME NULL DEFAULT NULL
	)'
];
