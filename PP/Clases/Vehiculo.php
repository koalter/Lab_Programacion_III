<?php
class Vehiculo
{
    public $marca;
    public $modelo;
    public $patente;
    public $precio;
    public $foto;

    public function __construct($marca, $modelo, $patente, $precio)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->patente = $patente;
        $this->precio = $precio;
    }

    static function Guardar($filename, $vehiculos, $conFoto)
    {
        $file = fopen($filename, "w");

        if ($conFoto)
        {
            foreach ($vehiculos as $vehiculo)
            {
                //var_dump($vehiculo);
                $string = $vehiculo->marca." ".$vehiculo->modelo." ".$vehiculo->patente." ".$vehiculo->precio." ".$vehiculo->foto . PHP_EOL;
                fwrite($file, $string);
            }
        }
        else
        {
            foreach ($vehiculos as $vehiculo)
            {
                //var_dump($vehiculo);
                $string = $vehiculo->marca . " " . $vehiculo->modelo . " " . $vehiculo->patente . " " . $vehiculo->precio . PHP_EOL;
                fwrite($file, $string);
            }
        }
        
        
        fclose($file);
    }

    public static function cargarVehiculo($filename)
    {
        $vehiculos = Vehiculo::vehiculos($filename);

        foreach ($vehiculos as $vehiculo)
        {
            if ($_POST['patente'] == $vehiculo->patente)
            {

                return "PATENTE REPETIDA!";
            }
        }
        $dummy = new Vehiculo($_POST['marca'], $_POST['modelo'], $_POST['patente'], $_POST['precio']);
        $vehiculos[] = $dummy;
        
        Vehiculo::Guardar($filename, $vehiculos, false);

        return $dummy;
    }

    public static function consultarVehiculo($filename)
    {
        $retorno = array();
        $flag = false;
        $vehiculos = Vehiculo::vehiculos($filename);
        if ($_GET['parametro'] != null)
        {
            foreach ($vehiculos as $vehiculo)
            {
                if (strcasecmp($_GET['parametro'], $vehiculo->modelo) == 0 ||
                    strcasecmp($_GET['parametro'], $vehiculo->marca) == 0 ||
                    strcasecmp($_GET['parametro'], $vehiculo->patente) == 0)
                {
                    $retorno[] = $vehiculo;

                    $flag = true;
                }
            }
            if (!$flag)
            {
                $retorno = "No existe vehiculo " . $_GET['parametro'];
            }
        }
        
        return $retorno;
    }
    
    public static function vehiculos($filename)
    {
        $vehiculos = array();
        
        if (file_exists($filename))
        {
            $file = fopen($filename, "r");

            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s %s %s\n");
                //var_dump($object);
                if ($object)
                {
                    $dummy = new Vehiculo($object[0], $object[1], $object[2], $object[3]);
                    $dummy->foto = $object[4];
                    $vehiculos[] = $dummy;
                    // var_dump($dummy);
                }
            }

            fclose($file);
        }

        return $vehiculos;
    }

    public static function modificarVehiculo($filename)
    {
        $vehiculos = Vehiculo::vehiculos($filename);
        $retorno = array();

        if ($_POST['patente'] != null)
        {
            foreach ($vehiculos as $vehiculo)
            {
                if ($_POST['patente'] == $vehiculo->patente)
                {
                    $retorno[] = json_encode($vehiculo);
                    if ($_POST['modelo'] != null || $_POST['modelo'] != '')
                        $vehiculo->modelo = $_POST['modelo'];
                    if ($_POST['marca'] != null || $_POST['marca'] != '')
                        $vehiculo->marca = $_POST['marca'];
                    if ($_POST['precio'] != null || $_POST['precio'] != '')
                        $vehiculo->precio = $_POST['precio'];
                    if ($_FILES != null)
                    {
                        $path = './'.$_FILES['imagen']['name'];
                        if (file_exists($path))
                        {
                            $destino = './backUpFotos/'.$vehiculo->patente." ".date("(d-m-y)", time()).".".pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                            if (!file_exists('./backUpFotos/'))
                                mkdir('./backUpFotos/');
                            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
                        }
                        $vehiculo->foto = $_FILES['imagen']['name'];
                    }
                    
                    $retorno[] = json_encode($vehiculo);
                }
            }

            Vehiculo::Guardar($filename, $vehiculos, true);
        }

        return $retorno;
    }

    public static function preciosBack($fvehiculos)
    {
        $vehiculos = Vehiculo::vehiculos($fvehiculos);
        $retorno = array();

        if (file_exists('./backUpprecios/'))
        {
            $listado = array_diff(scandir('./backUpprecios'), array('..', '.'));

            foreach ($listado as $elemento)
            {
                $explode = explode('.', $elemento);
                $str = sscanf($explode[0], "%d %s");

                foreach ($vehiculos as $vehiculo)
                {
                    if ($vehiculo->marca == $str[0])
                    {
                        $retorno[] = $vehiculo->modelo.' '.$str[1];  
                    }
                }
            }
        }

        return $retorno;
    }
}

?>