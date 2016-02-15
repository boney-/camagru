<?php

include_once 'photo.php';

$sql = 'SELECT * FROM photo';

try{
    $req = $DB->query($sql);
    while($d = $req->fetch(PDO::FETCH_ASSOC)){
        display_photo($d['id'], $d['url'], $d['description'], $d['like_count'], "photo-container", $DB);
    }
}
catch(PDOException $e){
    echo 'requete down';
}

?>