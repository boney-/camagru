<?php

include_once 'inc/db_connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function check_vote($id_photo, $id_user, $db)
{

    $sql = $db->prepare("SELECT * FROM vote WHERE photo_id = ? AND user_id = ?");
    $sql->execute(array($id_photo, $id_user));
    if ($sql->fetch())
        return (true);
    else
        return (false);
}

// <script>
// alert("HELLO!")
// </script>

if (isset($_GET['id'])) {

    if (!check_vote($_GET['id'], $_SESSION['auth']->id, $pdo)) {

        $sql = $pdo->prepare("INSERT INTO vote VALUES (NULL, ?, ?)");
        $sql->execute(array($_SESSION['auth']->id, $_GET['id']));
    }
}
?>