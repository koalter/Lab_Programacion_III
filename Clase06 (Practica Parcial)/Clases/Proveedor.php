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

    public function Guardar()
    { // TODO: falta hacer algo que haga al id unico
        $stream = "";
        $filename = "./proveedores.txt";
        $fp = fopen($filename, "r");
        if ($fp)
        {
            $stream = fread($fp, filesize($filename));
            fclose($fp);
        }
        
        $fp = fopen($filename, "w");
        if ($fp)
        {
            $stream = $stream . $this->id . " " . $this->nombre . " " . $this->email . " " . $this->foto . PHP_EOL;
            fwrite($fp, $stream);
        }
        fclose($fp);

        return $stream;
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