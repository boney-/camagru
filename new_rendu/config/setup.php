<?php 

require 'database.php';

function db_create($host, $user, $password, $name)
{
	$db = mysqli_connect($host, $user, $password);
	$pdo = new PDO("mysql:host=$host", $user, $password);
	$req = $pdo->prepare("CREATE DATABASE IF NOT EXISTS ".$name." CHARACTER SET 'utf8'");
	if ($req->execute()){
		mysqli_close($db);
		echo "Database created.\n";
		return 1;
	} else {
		mysqli_close($db);
		echo "Error while creating database\n";
		return -1;
	}
}

function table_create($host, $dsn, $user, $tables, $pw)
{
	$pdo = new PDO($dsn,$user,$pw);
	foreach ($tables as $table){
		try {
			$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS ". $table)->execute();
		} catch(PDOException $exception) {
			echo "Error while creating table ".explode(' ', $table)[0].".\n";
			exit();
		}
	}
}

db_create($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
table_create($DB_HOST, $DB_DSN, $DB_USER, $DB_TABLE, $DB_PASSWORD);
