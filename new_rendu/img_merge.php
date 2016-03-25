<?php
/*
header ("Content-type: image/jpeg"); // L'image que l'on va créer est un jpeg

// On charge d'abord les images
$source = imagecreatefrompng("img/filters/1.png"); // Le logo est la source

$destination = imagecreatefromjpeg("img/img1.jpg"); // La photo est la destination

// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo
$destination_x = $largeur_destination - $largeur_source;
$destination_y =  $hauteur_destination - $hauteur_source;

// On met le logo (source) dans l'image de destination (la photo)
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 50); 

// On affiche l'image de destination qui a été fusionnée avec le logo
imagejpeg($destination);
*/

$imgl = "img/img1.jpg";
$img2 = "img/filters/1.png";

$dest = imagecreatefromjpeg($imgl);
$src = imagecreatefrompng($img2);

imagecolortransparent($src, imagecolorat($src, 0, 0));

$src_x = imagesx($src);
$src_y = imagesy($src);
imagecopymerge($dest, $src, 0, 0, 0, 0, $src_x, $src_y, 100);

// Output and free from memory
header('Content-Type: image/png');
imagejpeg($dest, 'img/test.jpg');

imagedestroy($dest);
imagedestroy($src);

?>