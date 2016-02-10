<?php
//Accès à la base de donnée
	$host="localhost";
	$db="test";
    $database="mysql:host=localhost;dbname=test";
    $user="root";
    $password="";
    //PDO permet la conexion avec la base de données
    $cnx=new PDO("mysql:host=$host;dbname=$db",$user,$password);
    //force l'execution en utf-8
    $cnx->exec("SET NAMES utf8");
?>