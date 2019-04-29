<?php
$estampa = imagecreatefrompng('../'.$_POST['estampa']);
$im = imagecreatefromjpeg('../'.$_POST['imagen']);

// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
$margen_dcho = 100;
$margen_inf = 100;
$sx = imagesx($estampa);
$sy = imagesy($estampa);

// Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
// ancho de la foto para calcular la posición de la estampa. 
imagecopymerge($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa), 20);

// Imprimir y liberar memoria
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>