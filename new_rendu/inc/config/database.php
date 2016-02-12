<?php
//instanciation object pdo
$pdo = new PDO('mysql:dbname=camagru;host=localhost', 'root', '');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//recuperation de erreur sous forme d'objet (par defaut =  tableau associatif)
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);