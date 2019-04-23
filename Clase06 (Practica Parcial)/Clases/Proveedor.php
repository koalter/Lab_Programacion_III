<?php
// PUNTO DE RETORNO
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
        $proveedores = array();
        $file = fopen($filename, "r");
        $id = 1;
        
        if ($file)
        {
            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s %s\n");
                //var_dump($object);
                if ($object)
                {
                    $id = $object[0];
                    $dummy = new Proveedor();
                    $dummy->Constructor($id, $object[1], $object[2], $object[3]);
                    $proveedores[] = $dummy;
                    // var_dump($dummy);
                }
            }
            $id++;
            var_dump($proveedores);

            fclose($file);
        }

        $file = fopen($filename, "w");
        $dummy = new Proveedor();
        $dummy->Constructor($id, $_POST['nombre'], $_POST['email'], $_POST['foto']);
        $proveedores[] = $dummy;

        foreach ($proveedores as $proveedor)
        {
            var_dump($proveedor);
            $string = $proveedor->id . " " . $proveedor->nombre . " " . $proveedor->email . " " . $proveedor->foto . PHP_EOL;
            fwrite($file, $string);
        }

        return $proveedores;
    }

    public function Consultar()
    {
        $retorno = '';
        $flag = false;
        $fp = fopen("./proveedores.txt", "r");
        if ($fp && $_GET['nombre'] != null)
        {
            while (!feof($fp))
            {
                $stream = fscanf($fp, "%s %s %s %s\n");
                if (strcasecmp($stream[1], $_GET['nombre']) == 0)
                {
                    $retorno = json_encode($stream);
                    $flag = true;
                }
            }
            if (!$flag)
            {
                $retorno = "No existe proveedor xxx";
            }
            fclose($fp);
        }
        
        return $retorno;
    }

    public function Listar()
    {
        $stream = "";
        $filename = "./proveedores.txt";
        $fp = fopen($filename, "r");
        if ($fp)
        {
            $stream = fread($fp, filesize($filename));
            fclose($fp);
        }

        return $stream;
    }
}

?>