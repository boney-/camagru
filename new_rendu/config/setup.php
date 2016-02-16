<?php 

require 'database.php';

function db_create($host, $user, $password, $name)
{
	$db = mysqli_connect($host, $user, $password);
	$query = "CREATE DATABASE IF NOT EXISTS ".$name." CHARACTER SET 'utf8'";
	if ($db->query($query)){
		mysqli_close($db);
		echo "Database created.\n";
		return 1;
	} else {
		mysqli_close($db);
		echo "Error while creating database\n";
		return -1;
	}
}

require_once '../inc/db_connect.php';

function table_create($name, $tables, $pdo)
{
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
table_create($DB_NAME, $DB_TABLE, $pdo);