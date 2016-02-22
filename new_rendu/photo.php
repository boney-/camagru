<?php 

require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// $req->execute([$user_id]);
// $user = $req->fetch();

?>

<?php require 'inc/header.php' ?>

	<h1 class="page_title"><?php echo $_GET['name'] ?></h1>

	<div class="wide_photo_div">
		<img src="img/img1.jpg">
	</div>

	<div class="comments">
		<div class="comment">
			<h2 class="comment_auth"><?php echo $_GET['name'] ?></h2>
			<div class="comment_msg">
				dnbkldfknbndfklbndlkfnblk nlkbndlkndklbn dknb
			</div>
		</div>
	</div>

<?php require 'inc/footer.php' ?>