<?php 

require_once 'database.php';

function db_create($DB_NAME, $pdo)
{
	$query = "CREATE DATABASE IF NOT EXISTS ".$DB_NAME." CHARACTER SET 'utf8'";
	if ($req->execute()){
		echo "Database created.\n";
		return 1;
	} else {
		echo "Error while creating database\n";
		return -1;
	}
}

function table_create($DB_NAME, $DB_TABLE, $pdo)
{
	mysql_select_db($DB_NAME, $pdo);
	$query = "CREATE TABLE IF NOT EXISTS ".$DB_CLIENTS." (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, login VARCHAR(30) UNIQUE NOT NULL, Pass VARCHAR(256) NOT NULL, Nom VARCHAR(30) NOT NULL, Prenom VARCHAR(30) NOT NULL, Email VARCHAR(45) UNIQUE NOT NULL, Access INT UNSIGNED NOT NULL)";
	if ($mysqli->query($query))
	{
		//echo "Client table created.\n";
		return 1;
	}
	else
	{
		//echo "Error while creating client table.".mysqli_error($mysqli)."\n";
		return 1;
	}
}

