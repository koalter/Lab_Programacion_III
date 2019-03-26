<?php
include_once "Alumno.php";

$miAlumno = new Alumno($_POST['nombre'], $_POST['dni'], $_POST['legajo']);

echo $miAlumno->RetornarJson();

$miAlumno->Guardar("ListadoAlumnos.txt");
?>