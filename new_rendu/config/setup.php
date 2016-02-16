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

function table_create($name, $array, $pdo)
{
	$tables = '';
	foreach ($array as $table => $columns){
		$tables .= $table . ' (';
		$count = count($columns);
		foreach ($columns as $column => $type) {
			$tables .=	$column . ' ' . $type;
			$tables .= $count > 1 ? ', ': '';
			$count--;
		}
		$tables .= ')';
		$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS ". $tables)->execute();
		



		if($req->execute([])){
			echo "tables table created.\n";
			return 1;
		}
		else{
			echo "Error while creating tables.\n";
			return -1;
		}
	}
}

db_create($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
table_create($DB_NAME, $DB_TABLE, $pdo);