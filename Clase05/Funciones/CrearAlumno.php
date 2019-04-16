<?php
include_once ("./Clases/Alumno.php");
// include_once "ListarAlumnos.php";

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $alumno = new Alumno();
    $alumno->Constructor($_POST['Apellido'], $_POST['Legajo'], $_POST['IdLocalidad']);
    echo "$alumno->Apellido; $alumno->Legajo; $alumno->IdLocalidad;";
    // $alumno->Guardar();
    $alumno->Insertar();
}

// echo json_encode($listado);

?>