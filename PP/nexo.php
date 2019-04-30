<?php
include_once ("./Clases/Vehiculo.php");
include_once ("./Clases/Servicio.php");
include_once ("./Clases/Turno.php");

$mensaje = "";
$fileVehiculos = "./vehiculos.txt";
$fileServicios = "./tiposServicio.txt";
$fileTurnos = "./turnos.txt";
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo)
{
    case 'POST':
        switch ($_POST['caso'])
        {
            case 'cargarVehiculo':
                $mensaje = json_encode(Vehiculo::cargarVehiculo($fileVehiculos));
                break;
            case 'cargarTipoServicio':
                $mensaje = json_encode(Servicio::cargarTipoServicio($fileServicios));
                break;
            case 'modificarVehiculo':
                $mensaje = json_encode(Vehiculo::modificarVehiculo($fileVehiculos));
                break;
            default:
                $mensaje = 'Usar la propiedad "caso" con el valor "cargarVehiculo" o "cargarTipoServicio"';
                break;
        }
        break;
    case 'GET':
        switch ($_GET['caso'])
        {
            case 'consultarVehiculo':
                $mensaje = json_encode(Vehiculo::consultarVehiculo($fileVehiculos));
                break;
            case 'sacarTurno':
                $mensaje = json_encode(Turno::sacarTurno($fileTurnos, $fileServicios, $fileVehiculos));
                break;
            case 'turnos':
                $mensaje = json_encode(Turno::turnos($fileTurnos));
                break;
            case 'inscripciones':
                $mensaje = json_encode(Turno::inscripciones($fileTurnos));
                break;
            case 'vehiculos':
                Vehiculo::vehiculos($fileVehiculos);
                break;
            default:
                $mensaje = 'Usar la propiedad "caso" con el valor "consultarVehiculo", "sacarTurno", "turnos", "vehiculos" o "inscripciones"';
                break;
        }
        break;
}

echo $mensaje;

?>