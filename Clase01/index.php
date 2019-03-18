<?php
//En esta clase vemos como mostrar un mensaje, crear variables, 
//mostrar el contenido de una variable, declarar y utilizar arrays, así como objetos.

echo "<h1>Hola Mundo</h1>";

$nombre="Lorenzo";
$edad=24;

echo $nombre;

echo "<br>";

var_dump($nombre);
echo "<br>";
var_dump($edad);
echo "<br>";

$miArray1 = array("Nombre" => "Lorenzo", "Edad" => 24);
var_dump($miArray1);
echo "<br>";

$miArray2 = array();
$miArray2["Nombre"] = "Lorenzo";
$miArray2["Edad"] = 24;
var_dump($miArray2);
echo "<br>";

$miObjeto = new stdClass();
$miObjeto->nombre="Lorenzo";
var_dump($miObjeto);
echo "<br>";

?>
