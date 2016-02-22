<?php
/**
 * Created by PhpStorm.
 * User: jbonnet
 * Date: 2/22/16
 * Time: 3:04 PM
 */

include_once 'db.php';

$_SESSION['auth']['id'] = 2;

$sql = $DB->prepare("INSERT INTO comment (user_id, photo_id, comment, created_at) VALUES (?, ?, ?, ?)");
$sql->execute(array($_SESSION['auth']['id'], $_POST['id'], $_POST['comment'], date("Y-m-d H:i:s")));

?>