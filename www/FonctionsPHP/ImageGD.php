<?php
session_start();

$im = ImageCreateFromJPEG('../Image/Picto/Fond.jpg');

$textcolor = imagecolorallocate($im, 0, 0, 255);

$text1 = $_GET["text1"];
$text2 = $_GET["text2"];
$font = '../Police/Comfortaa-Regular.ttf';
$white = imagecolorallocate($im, 255, 255, 255);


$Angle=20;
$Agrandissement=30;
$bbox = imagettfbbox($Agrandissement, $Angle, $font, $text1);
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2);
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2);
imagettftext($im, $Agrandissement, $Angle, $x+3, $y+10, $white, $font, $text1);


$Agrandissement=15;
$bbox = imagettfbbox($Agrandissement, $Angle, $font, $text2);
$x = $bbox[0] + (imagesx($im) / 2) - ($bbox[4] / 2);
$y = $bbox[1] + (imagesy($im) / 2) - ($bbox[5] / 2);
imagettftext($im, $Agrandissement, $Angle, $x-10, $y-30, $white, $font, $text2);

header('Content-type: image/jpeg');

imagepng($im);
imagedestroy($im);
?>
