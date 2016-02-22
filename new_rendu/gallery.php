<?php 

// require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM photo ORDER BY created_at DESC');
// $req->execute();

// $name = "toto";
require 'inc/header.php'

?>



	<h1 class="page_title">Gallery</h1>

	<div class="small_photo_div">
		<a href="photo.php?name=$name">
		 	<span class="helper"></span>
			<img src="img/img0.jpg">
		</a>
		<a href="photo.php?name=$name">
		 	<span class="helper"></span>
			<img src="img/img1.jpg">
		</a>
		<a href="photo.php?name='$name'">
		 	<span class="helper"></span>
			<img src="img/img2.jpg">
		</a>
		<a href="photo.php?name=$name">
		 	<span class="helper"></span>
			<img src="img/img3.jpg">
		</a>
	</div>

<?php require 'inc/footer.php' ?>