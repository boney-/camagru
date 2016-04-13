<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 13/04/2016
 * Time: 04:02
 */

require_once 'inc/db_connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['auth']->id)
{
    $sql = $pdo->prepare("delete from photo where user_id = ? and id = ?");
    $sql->execute(array($_SESSION['auth']->id, $_GET['id']));

    $sql = $pdo->prepare("SELECT * FROM photo WHERE user_id = ? ORDER BY created_at LIMIT 4");
    $sql->execute(array($_SESSION['auth']->id));
    while ($req = $sql->fetch(PDO::FETCH_ASSOC)){
        echo '<div class="img-wrap"><span class="close" onclick="(delete_img('.$req["id"].'))">&times;</span><a href="photo.php?id='.$req["id"].'"><img src="'.$req["url"].'" /></a></div>';
    }
}