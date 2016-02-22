<?php

include_once 'db.php';

$_SESSION['auth']['id'] = 2;

function check_vote($id_photo, $id_user, $DB)
{
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
echo $_GET['id'];
if (preg_match("([0-9])",$_GET['id']))
{
    echo $_GET['id'];
    if (!check_vote($_GET['id'], $_SESSION['auth']['id'], $DB))
    {
        echo $_GET['id'];
        
        
        $sql = "INSERT INTO vote VALUES (NULL, ".$_SESSION['auth']['id'].",".$_GET['id'].")";
        $req = $DB->query($sql);
    }
}

?>