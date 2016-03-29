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
    <script type="text/javascript" src="js/vote.js"> </script>
  </head>

  <body>
    <nav class="navbar">
      <div class="container">
        <div class="brand_div">
          <a class="brand" href="gallery.php"><h1>Camagru</h1></a>
        </div>
        <div id="navbar">
          <ul class="nav">
            <?php if(isset($_SESSION['auth'])): ?>
              <li><a href="capture.php">Vos montages</a></li>
              <li><a href="logout.php">Deconnexion</a></li>
              <?php else: ?>
                <li><a href="register.php">S'inscrire</a></li>
                <li><a href="login.php">Se connecter</a></li>
              <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

      <!-- affichage des message d'erreur s'il y en a -->
      <?php if(isset($_SESSION['flash'])) : ?>
        <?php foreach($_SESSION['flash'] as  $type => $message) : ?>
          <div class="msg <?= $type; ?>">
            <?= $message; ?>
          </div>
        <?php endforeach ?>
        <?php unset($_SESSION['flash']); ?>
      <?php endif; ?>
