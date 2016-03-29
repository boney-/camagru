<?php 
$user_id = $_GET['id'];
$token = $_GET['token'];
require 'inc/db_connect.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();

//echo("confirmation token : >". $user->confirmation_token . "<\n");
//echo("token : >".$token."<");

session_start();

//connect user if token comfirmed
if ($user && $user->confirmation_token == $token) {
	$req = $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
	$_SESSION['flash']['success_msg'] = "Votre compte a bien été validé";
	$_SESSION['auth'] = $user;
	header('Location: account.php');
} else {
	$_SESSION['flash']['error_msg'] = "Ce token n'est plus valide";
	header('Location: login.php');
}