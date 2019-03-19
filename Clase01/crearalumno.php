<?php
//Uso de métodos Get, Post y Request

include "alumno.php";

echo "get";
var_dump($_GET);

//echo "<br>";
echo "post";
var_dump($_POST);

//echo "<br>";
echo "request";
var_dump($_REQUEST);

$nombre = $_POST['nombre'];

echo "<br>";
$otroAlumno = new AlumnoEjemplo($nombre);
echo $otroAlumno->nombre;

?>