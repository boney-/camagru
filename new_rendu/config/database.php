<?php

$DB_DSN = 'mysql:dbname=camagru;host=localhost';
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'camagru2';
$DB_TABLE = [
	'users' => [
		'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
		'username' => 'VARCHAR(250) NOT NULL',
		'email' => 'VARCHAR(250) NOT NULL',
		'password' => 'VARCHAR(250) NOT NULL',
		'confirmation_token' => 'VARCHAR(60) NULL DEFAULT NULL',
		'confirm_at' => 'DATETIME NULL DEFAULT NULL',
		'reset_token' => 'VARCHAR(60) NULL DEFAULT NULL',
		'reset_at' => 'DATETIME NULL DEFAULT NULL',
		'remember_token' => 'VARCHAR(250) NULL DEFAULT NULL'
	]/*,
	'photo' => [
	]*/
];