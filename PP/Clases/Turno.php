<?php

class Turno
{
    public $fecha;
    public $patente;
    public $marca;
    public $modelo;
    public $precio;
    public $tipoServicio;

    public function __construct($fecha, $patente, $marca, $modelo, $precio, $tipoServicio)
    {
        $this->fecha = $fecha;
        $this->patente = $patente;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
        $this->tipoServicio = $tipoServicio;
    }

    static function Guardar($filename, $turnos)
    {
        $file = fopen($filename, "w");

        foreach ($turnos as $turno)
        {
            //var_dump($turno);
            $string = $turno->fecha . " " . $turno->patente . " " . $turno->marca . " "  . $turno->modelo . " " . $turno->precio . " " . $turno->tipoServicio . PHP_EOL;
            fwrite($file, $string);
        }
        
        fclose($file);
    }

    public static function turnos($filename)
    {
        $turnos = array();
        
        if (file_exists($filename))
        {
            $file = fopen($filename, "r");

            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s %s %s %s\n");
                //var_dump($object);
                if ($object)
                {
                    $dummy = new Turno($object[0], $object[1], $object[2], $object[3], $object[4], $object[5]);
                    $turnos[] = $dummy;
                    // var_dump($dummy);
                }
            }

            fclose($file);
        }

        return $turnos;
    }

    public static function sacarTurno($fTurnos, $fServicios, $fVehiculos)
    {
        $turnos = Turno::turnos($fTurnos);
        $vehiculos = Vehiculo::vehiculos($fVehiculos);
        $servicios = Servicio::listarServicios($fServicios);
        $marca = '';
        $modelo = '';
        $precio = '';
        $tipoServicio = '';
        
        foreach ($vehiculos as $vehiculo)
        {
            if ($vehiculo->patente == $_GET['patente'])
            {
                $marca = $vehiculo->marca;
                $modelo = $vehiculo->modelo;

                if ($_GET['fecha'] <= 31 && $_GET['fecha'] > 0)
                {
                    if ($_GET['fecha'] > 20)
                    {
                        $tipoServicio = 50000;
                    }
                    else if ($_GET['fecha'] > 10)
                    {
                        $tipoServicio = 20000;
                    }
                    else if ($_GET['fecha'] > 1)
                    {
                        $tipoServicio = 10000;
                    }
                }
                else return;

                foreach ($servicios as $servicio)
                {
                    if ($servicio->tipo == $tipoServicio)
                    {
                        $precio = $servicio->precio;
                    }
                }
            }
        }

        $dummy = new Turno($_GET['fecha'], $_GET['patente'], $marca, $modelo, $precio, $tipoServicio);
        $turnos[] = $dummy;
        
        Turno::Guardar($fTurnos, $turnos);

        return $dummy;
    }

    public static function inscripciones($filename)
    {
        $retorno = array();
        $flag = false;
        $turnos = Turno::turnos($filename);
        if ($_GET['parametro'] != null)
        {
            foreach ($turnos as $turno)
            {
                if (strcasecmp($_GET['parametro'], $turno->tipoServicio) == 0 ||
                    strcasecmp($_GET['parametro'], $turno->fecha) == 0)
                {
                    $retorno[] = $turno;

                    $flag = true;
                }
            }
            if (!$flag)
            {
                $retorno = "No existe turno " . $_GET['parametro'];
            }
        }
        
        return $retorno;
    }
}
?>