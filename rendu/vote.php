<?php

include_once 'db.php';

$_SESSION['auth']['id'] = 2;

function check_vote($id_photo, $id_user, $DB)
{
    echo "vOTE";
    $sql = "SELECT * FROM vote WHERE photo_id = $id_photo AND user_id =". $id_user;
    $req = $DB->query($sql);
    if ($req->fetch())
        return (true);
    else
        return (false);
}

// <script>
// alert("HELLO!");
// </script>
if (preg_match("([0-9])\w+4",$_POST['id']))
{
    if (check_vote($_GET['id'], $_SESSION['auth']['id'], $DB))
    {
        echo "vOTE";
        
        $sql = "INSERT INTO vote VALUES (NULL, ".$_GET['id'].",".$_SESSION['auth']['id'].")";
        $req = $DB->query($sql);
    }
}

?>