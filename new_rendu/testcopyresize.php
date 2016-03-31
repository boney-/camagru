<?php
// Fichier et nouvelle taille
$filename = 'img/filters/2.png';
$percent = 1;

// Content type
header('Content-Type: image/png');

// Calcul des nouvelles dimensions
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Chargement
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefrompng($filename);

// Redimensionnement
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Affichage
imagepng($thumb);
