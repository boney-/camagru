<?php

function check_vote($id_photo, $id_user, $DB)
{
    $sql = "SELECT vote FROM votes WHERE photo_id = $id_photo AND user_id =". $id_user;
    $req = $DB->query($sql);
    if ($req->fetch())
        return (true);
    else
        return (false);
}

if (preg_match("([0-9])\w+4",$_POST['id']))
{
    if (!check_vote($_POST['id'], $_SESSION['auth']['id'], $DB))
    {
        $sql = "INSERT INTO votes ('photo_id', 'user_id', 'vote') VALUES (".$_POST['id'].",".$_SESSION['auth']['id'].", 1)";
    }
}

?>