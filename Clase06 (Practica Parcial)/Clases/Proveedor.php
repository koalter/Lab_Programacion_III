<?php
class Proveedor
{
    public $id;
    public $nombre;
    public $email;
    public $foto;

    public function Constructor($id, $nombre, $email, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->foto = $foto;
    }

    public function cargarProveedor($filename)
    {
        $proveedores = $this->proveedores($filename);
        $id = sizeof($proveedores) + 1;

        $file = fopen($filename, "w");
        $dummy = new Proveedor();
        $dummy->Constructor($id, $_POST['nombre'], $_POST['email'], $_POST['foto']);
        $proveedores[] = $dummy;

        foreach ($proveedores as $proveedor)
        {
            //var_dump($proveedor);
            $string = $proveedor->id . " " . $proveedor->nombre . " " . $proveedor->email . " " . $proveedor->foto . PHP_EOL;
            fwrite($file, $string);
        }

        return $proveedores;
    }

    public function consultarProveedor($filename)
    {
        $retorno = '';
        $flag = false;
        $proveedores = $this->proveedores($filename);
        if ($_GET['nombre'] != null)
        {
            foreach ($proveedores as $proveedor)
            {
                if ($_GET['nombre'] == $proveedor->nombre)
                {
                    $retorno = $proveedor;
                }
            }
            if (!$flag)
            {
                $retorno = "No existe proveedor " . $_GET['nombre'];
            }
            fclose($fp);
        }
        
        return $retorno;
    }

    // Lista a los proveedores por echo
    // y retorna un array de proveedores
    public function proveedores($filename)
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
                    $dummy = new Proveedor();
                    $dummy->Constructor($object[0], $object[1], $object[2], $object[3]);
                    $proveedores[] = $dummy;
                    // var_dump($dummy);
                }
            }
            //var_dump($proveedores);

            fclose($file);
        }

        return $proveedores;
    }
}

?>