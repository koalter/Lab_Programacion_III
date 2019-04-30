<?php

class Servicio
{
    public $id;
    public $tipo;
    public $precio;
    public $demora;

    public function __construct($id, $tipo, $precio, $demora)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->demora = $demora;
    }

    public static function cargarTipoServicio($fServicios)
    {
        $servicios = Servicio::listarServicios($fServicios);
        $dummy = null;
        
        if ($_POST['tipo'] == 10000 || $_POST['tipo'] == 20000 || $_POST['tipo'] == 50000)
        {
            foreach ($servicios as $servicio)
            {
                if ($_POST['id'] == $servicio->id)
                {
    
                    return "ID REPETIDA!";
                }
            }

            $dummy = new Servicio($_POST['id'], $_POST['tipo'], $_POST['precio'], $_POST['demora']);
            $servicios[] = $dummy;
            $file = fopen($fServicios, "w");
    
            foreach ($servicios as $servicio)
            {
                $string = $servicio->id . " " . $servicio->tipo . " " . $servicio->precio . " " . $servicio->demora . PHP_EOL;
                fwrite($file, $string);
            }
    
            fclose($file);
        }

        return $dummy;
    }

    public static function listarServicios($filename)
    {
        $servicios = array();
        
        if (file_exists($filename))
        {
            $file = fopen($filename, "r");
            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s %s\n");
                // var_dump($object);
                if ($object)
                {
                    $dummy = new Servicio($object[0], $object[1], $object[2], $object[3]);
                    $servicios[] = $dummy;
                    // var_dump($dummy);
                }
            }
            // var_dump($Servicios);

            fclose($file);
        }

        return $servicios;
    }
}

?>