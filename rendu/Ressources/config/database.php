<?php
//Accès à la base de donnée
    $database="mysql:host=localhost;dbname=test";
    $user="root";
    $password="";
    //PDO permet la conexion avec la base de données
    $cnx=new PDO($database,$user,$password);
    //force l'execution en utf-8
    $cnx->exec("SET NAMES utf8");
?>