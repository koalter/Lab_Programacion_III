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

        $dummy = new Proveedor($id, $_POST['nombre'], $_POST['email'], $_FILES['foto']['name']);
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
                    if ($_FILES != null)
                    {
                        $path = './'.$proveedor->foto;
                        if (file_exists($path))
                        {
                            $destination = './backUpFotos/'.$proveedor->id.' '.date('(d-m-y)', time()).'.'.pathinfo($path, PATHINFO_EXTENSION);
                            if (!file_exists('./backUpFotos/'))
                                mkdir('./backUpFotos/');
                            rename($path, $destination);
                        }
                        $proveedor->foto = $_FILES['foto']['name'];
                    }
                    
                    $retorno[] = json_encode($proveedor);
                }
            }

            Proveedor::Guardar($filename, $proveedores);
        }

        return $retorno;
    }

    public static function fotosBack($fproveedores)
    {
        $proveedores = Proveedor::proveedores($fproveedores);
        $retorno = array();

        if (file_exists('./backUpFotos/'))
        {
            $listado = array_diff(scandir('./backUpFotos'), array('..', '.'));

            foreach ($listado as $elemento)
            {
                $explode = explode('.', $elemento);
                $str = sscanf($explode[0], "%d %s");

                foreach ($proveedores as $proveedor)
                {
                    if ($proveedor->id == $str[0])
                    {
                        $retorno[] = $proveedor->nombre.' '.$str[1];  
                    }
                }
            }
        }

        return $retorno;
    }
}

?>