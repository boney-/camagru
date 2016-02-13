<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success_msg'] = "Vous êtes maintenant déconnecté";
header('Location: login.php');