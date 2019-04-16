<?php
include "./Clases/AccesoDatos.php";
include "./Clases/Alumno.php";

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo)
{
    case 'GET':
        echo json_encode(Alumno::TraerTodosLosAlumnos());
        // include_once ("./Funciones/ListarAlumnos.php");
        break;
    case 'POST':
        // include_once ("./Funciones/CrearAlumno.php");
        break;
    default:
        echo "Proba con GET primero!";
        break;
}

?>