<?php
require_once 'config/database.php';

//connect to database
try {
	//instanciation object pdo
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//recuperation de erreur sous forme d'objet (par defaut =  tableau associatif)
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch(PDOException $error) {
	die($error->getMessage());
}