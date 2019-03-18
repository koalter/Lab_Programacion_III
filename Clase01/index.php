<?php
//En esta clase vemos como mostrar un mensaje, crear variables, 
//mostrar el contenido de una variable, declarar y utilizar arrays, así como objetos.
include "alumno.php";

echo "<h1>Hola Mundo</h1>";

$nombre = "Lorenzo";
$edad = 24;

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

$miAlumno = new Alumno();
$miAlumno->nombre = "Lore";
$miAlumno->edad = 23; 
var_dump($miAlumno);
echo "<br>";

$alumno2 = new Alumno();
$alumno2->nombre = "Ana";
$alumno2->edad = 19;
var_dump($alumno2);
echo "<br>";

$alumno2->retornarjson();
echo "<br>";

$miAlumno->retornarjson();
echo "<br>";
?>
