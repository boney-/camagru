<?php 

require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// $req->execute([$user_id]);
// $user = $req->fetch();

?>

<?php

require 'inc/header.php';
require_once 'inc/db_connect.php';

$sql = $pdo->prepare("SELECT url, title, description, DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at, username FROM users, photo WHERE photo.id = ? AND photo.user_id = users.id");
if (isset($_GET['id'])) {
	$sql->execute(array($_GET['id']));
	$req = $sql->fetch(PDO::FETCH_ASSOC);

	$sql = $pdo->prepare("SELECT COUNT(id) AS like_count FROM vote WHERE photo_id = ?");
	$sql->execute(array($_GET['id']));
	$req3 = $sql->fetch(PDO::FETCH_ASSOC);

	$sql = $pdo->prepare("SELECT username, comment.id, comment, created_at FROM users, comment WHERE photo_id = ? AND comment.user_id = users.id ORDER BY created_at ASC");
	$sql->execute(array($_GET['id']));
?>

	<h1 class="page_title"><?php echo $req['title'] ?></h1>

	<h2 class="created_at">Sent by 
		<span class="created_by"><?php echo $req['username'] ?></span>
		<?php echo $req['created_at'] ?>

	</h2>

	<div class="wide_photo_div">
		<img src="<?php echo $req['url'] ?>"><br/>
		<div class="description_div">
			<div onclick="vote(<?php echo $_GET['id'] ?>)" id="vote_scr" class="<?php if (!isset($_SESSION['auth']) || !check_vote($_GET['id'], $_SESSION['auth']->id, $pdo)) echo 'vote_div'; else echo 'has_voted';?> float_right">
				<div id="like">
					<?php echo (isset($req3['like_count']) ? $req3['like_count'] : NULL) ?>
				</div>
				<div id="like_it"><img src="img/like.png"></div>
			</div>
			<div class="description"><?php echo $req['description'] ?></div>
		</div>
	</div>

	<div class="comments" id="allcomments">
		<?php while ($req2 = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
		<div class="comment" >
			<span class="comment_auth"><?php echo $req2['username'] ?>: </span>
				<?php echo $req2['comment'];
				echo "<span class='line'></span>"; ?>
		</div>
		<?php } ?>
		<div class="add_comment">
			<textarea name="comment" form="comment" id="comment" placeholder="commentaire ..."></textarea>
			<button onclick="send_comment(<?php  echo $_GET['id']?>)" action="" type="sutbmit" class="send_btn submit_btn">Envoyer</button>
		</div>
	</div>
<?php
}
	require 'inc/footer.php'
?>


