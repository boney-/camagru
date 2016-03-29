<?php

include_once 'inc/db_connect.php';
include_once 'inc/functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['id'])) {

    if (isset($_SESSION['auth']) && !check_vote($_GET['id'], $_SESSION['auth']->id, $pdo)) {

        $sql = $pdo->prepare("INSERT INTO vote VALUES (NULL, ?, ?)");
        $sql->execute(array($_SESSION['auth']->id, $_GET['id']));
    }
    $sql = $pdo->prepare("SELECT COUNT(id) as vote FROM vote WHERE photo_id = ?");
    $sql->execute(array($_GET['id']));
    $vote = $sql->fetch(PDO::FETCH_ASSOC);
    echo $vote['vote'];
}
?>