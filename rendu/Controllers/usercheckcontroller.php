<?php
session_start();
include_once('bd.php');
spl_autoload_register(function ($class_name) {
   include 'Models/'.$class_name . '.class.php';
});

$error_msg='';

if (isset($_POST['email']) && isset($_POST['password']) && (strlen($_POST['email'])>0) && (strlen($_POST['password'])>0))
{    
    //$retour_verif = id ou false 
    $user=new User();
    $retour_verif=$user->verifier_mdp($_POST['email'],$_POST['password']);
    
    if($retour_verif=='no_user')
    {
        $error_msg="l'adresse email saisie est invalide ou n'existe pas.";
        /*header("refresh:1;url=index.php" );*/
    }
    else if($retour_verif=='wrong_pass')
    {
        $error_msg="le mot de passe est erroné";
    }    
    else
    {
        $_SESSION['id_user'] = $user->get_iduser();
        $_SESSION['prenom_user'] = $user->get_prenom();
        header ('location: index.php');
    }    
}
else{ $error_msg="Veuillez renseigner tout les champs";}

?>