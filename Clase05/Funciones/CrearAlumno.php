<?php
include_once "../Clases/Alumno.php";
include_once "ListarAlumnos.php";

$alumno = new Alumno();
$alumno->Constructor($_POST['Apellido'], $_POST['Legajo'], $_POST['Localidad']);
$alumno->Guardar();
$alumno->Insertar();

// echo json_encode($listado);

?>