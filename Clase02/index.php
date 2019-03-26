<?php
include "Alumno.php";

$miAlumno = new Alumno($_POST['nombre'], $_POST['dni'], $_POST['legajo']);
$miAlumno->Guardar('ListadoAlumnos.txt');
$miAlumno->GuardarJson();
?>