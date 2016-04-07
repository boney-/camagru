<?php
/**
 * Created by PhpStorm.
 * User: jbonnet
 * Date: 2/22/16
 * Time: 3:04 PM
 */

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once 'inc/db_connect.php';

if ($_SESSION['auth']->id) {

    $_POST['comment'] = htmlspecialchars($_POST['comment']);
    $sql = $pdo->prepare("INSERT INTO comment (user_id, photo_id, comment, created_at) VALUES (?, ?, ?, ?)");
    $sql->execute(array($_SESSION['auth']->id, $_POST['id'], $_POST['comment'], date("Y-m-d H:i:s")));

    $sql = $pdo->prepare("SELECT username, comment.id, comment, created_at FROM users, comment WHERE photo_id = ? AND comment.user_id = users.id ORDER BY created_at ASC");
    $sql->execute(array($_POST['id']));
    while ($res = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="comment">
            <span class="comment_auth"><?php echo $res['username'] ?>: </span>
            <?php echo $res['comment'];
            echo "<span class='line'></span>"; ?>
        </div>
        <?php
    }
    $author = $_SESSION['auth']->username;
    $sql = $pdo->prepare("SELECT email FROM users, photo WHERE users.id = photo.user_id AND photo.id = ?");
    $sql->execute(array($_POST['id']));
    $res = $sql->fetch(PDO::FETCH_ASSOC);
    $email = $res['email'];
    $sql = $pdo->prepare("SELECT title FROM photo WHERE id = ?");
    $sql->execute(array($_POST['id']));
    $res = $sql->fetch(PDO::FETCH_ASSOC);
    mail($email, "Nouveau commentaire", "Nouveau commentaire sur votre image: (".$res['title'].") de la part de ".$author." \n 
    commentaire: ".$_POST['comment']."\n
    http://localhost:8080/photo?id=".$_POST['id']);
}
else{
    echo 'you must login first in order to comment';
}

?>
<div class="add_comment">
    <textarea name="comment" form="comment" id="comment" placeholder="commentaire ..."></textarea>
    <button onclick="send_comment(<?php echo $_POST['id']?>)" action="" type="sutbmit" class="send_btn submit_btn">Envoyer</button>
</div>
