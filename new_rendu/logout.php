<?php
session_start();
//supression du coukkie
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success_msg'] = "Vous êtes maintenant déconnecté";
header('Location: login.php');