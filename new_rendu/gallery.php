<?php 

// require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM photo ORDER BY created_at DESC');

// $photos = $req->execute();
require 'inc/header.php';
require_once 'inc/db_connect.php';

$sql = $pdo->prepare("SELECT * From photo ORDER BY created_at DESC");
$sql->execute();

?>

	<h1 class="page_title">Gallerie Photos</h1>

	<div class="small_photo_div">
		<?php While ($res = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
		<a href="photo.php?id=<?php echo $res['id'] ?>">
		 	<span class="helper"></span>
			<img src="<?php echo $res['url'] ?>">
		</a>
		<?php } ?>
	</div>

<?php require 'inc/footer.php' ?>