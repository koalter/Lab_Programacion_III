<?php
include_once '../Clases/Alumno.php';
include_once 'ListarAlumnos.php';

$filename = '../ListadoAlumnos.json';
$listado = ListarAlumnos($filename);

$listado[] = new Alumno($_POST['apellido'], $_POST['legajo']);
$handler = fopen($filename, 'w');

if ($handler)
{
    $json = json_encode($listado);

    fwrite($handler, $json);

    fclose($handler);
}

echo json_encode($listado);

?>