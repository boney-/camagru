<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 13/04/2016
 * Time: 03:27
 */

require_once 'inc/functions.php';
require_once 'inc/db_connect.php';
is_logged();

function urlfinder($rep, $id){
    $i = 0;
    while (file_exists($rep.$id."-".$i.".jpg")) $i++;
    return "img/$id-$i.jpg";
}

if ($_POST['title'] && $_POST['comment']){
    $path = urlfinder("img/", $_SESSION['auth']->id);
    copy("img/tmp/".$_SESSION['auth']->id."-user_img.jpg", $path);
    $sql = $pdo->prepare("INSERT INTO photo (user_id, url, title, description, created_at) VALUE (?, ?, ?, ?, ?)");
    $sql->execute(array($_SESSION['auth']->id, $path, $_POST['title'], $_POST['comment'], date("Y-m-d H:i:s")));
}

header('Location: capture.php');