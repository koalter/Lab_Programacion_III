<?php
class Proveedor
{
    public $id;
    public $nombre;
    public $email;
    public $foto;

    // public function Constructor($id, $nombre, $email, $foto)
    // {
    //     $this->id = $id;
    //     $this->nombre = $nombre;
    //     $this->email = $email;
    //     $this->foto = $foto;
    // }

    public function __construct($id, $nombre, $email, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->foto = $foto;
    }

    static function Guardar($filename, $proveedores)
    {
        $file = fopen($filename, "w");

        foreach ($proveedores as $proveedor)
        {
            //var_dump($proveedor);
            $string = $proveedor->id . " " . $proveedor->nombre . " " . $proveedor->email . " " . $proveedor->foto . PHP_EOL;
            fwrite($file, $string);
        }

        fclose($file);
    }

    public static function cargarProveedor($filename)
    {
        $proveedores = Proveedor::proveedores($filename);
        $id = sizeof($proveedores) + 1;

        $dummy = new Proveedor($id, $_POST['nombre'], $_POST['email'], $_POST['foto']);
        $proveedores[] = $dummy;
        
        Proveedor::Guardar($filename, $proveedores);

        return $dummy;
    }

    public static function consultarProveedor($filename)
    {
        $retorno = array();
        $flag = false;
        $proveedores = Proveedor::proveedores($filename);
        if ($_GET['nombre'] != null)
        {
            foreach ($proveedores as $proveedor)
            {
                if (strcasecmp($_GET['nombre'], $proveedor->nombre) == 0)
                {
                    $retorno[] = $proveedor;

                    $flag = true;
                }
            }
            if (!$flag)
            {
                $retorno = "No existe proveedor " . $_GET['nombre'];
            }
        }
        
        return $retorno;
    }

    public static function consultarProveedorPorId($proveedores)
    {
        $flag = false;

        if ($_POST['idProveedor'] != null)
        {
            foreach ($proveedores as $proveedor)
            {
                if ($_POST['idProveedor'] == $proveedor->id)
                {
                    $flag = true;
                }
            }
        }
        
        return $flag;
    }

    // Lista a los proveedores por echo
    // y retorna un array de proveedores
    public static function proveedores($filename)
    {
        $proveedores = array();
        $file = fopen($filename, "r");
        
        if ($file)
        {
            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s %s\n");
                //var_dump($object);
                if ($object)
                {
                    $dummy = new Proveedor($object[0], $object[1], $object[2], $object[3]);
                    $proveedores[] = $dummy;
                    // var_dump($dummy);
                }
            }
            //var_dump($proveedores);

            fclose($file);
        }

        return $proveedores;
    }

    public static function modificarProveedor($filename)
    {
        $proveedores = Proveedor::proveedores($filename);
        $retorno = array();

        if ($_POST['id'] != null)
        {
            foreach ($proveedores as $proveedor)
            {
                if ($_POST['id'] == $proveedor->id)
                {
                    $retorno[] = json_encode($proveedor);
                    if ($_POST['nombre'] != null || $_POST['nombre'] != '')
                        $proveedor->nombre = $_POST['nombre'];
                    if ($_POST['email'] != null || $_POST['email'] != '')
                        $proveedor->email = $_POST['email'];
                    if ($_POST['foto'] != null || $_POST['foto'] != '')
                        $proveedor->foto = $_POST['foto'];
                    
                    $retorno[] = json_encode($proveedor);
                }
            }

            Proveedor::Guardar($filename, $proveedores);
        }

        return $retorno;
    }
}

?>