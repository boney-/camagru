<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Camagru</title>

    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar">
      <div class="container">
        <div class="brand_div">
          <a class="brand" href="#"><h1>Camagru</h1></a>
        </div>
        <div id="navbar">
          <ul class="nav">
            <li><a href="register.php">S'inscrire</a></li>
            <li><a href="login.php">Se connecter</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <!-- affichage des message d'erreur s'il y en a -->
      <?php if(isset($_SESSION['flash'])) : ?>
        <?php foreach($_SESSION['flash'] as  $type => $message) : ?>
          <div class="<?= $type; ?>">
              <?= $message; ?>
          </div>
        <?php endforeach ?>
        <?php unset($_SESSION['flash']); ?>
      <?php endif; ?>
