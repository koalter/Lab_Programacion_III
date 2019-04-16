<?php

function ListarAlumnos($filename)
{
    $fp = fopen($filename, 'r');
    
    if ($fp)
    {
        $size = filesize($filename);
        if ($size > 0)
        {
            $stream = fread($fp, filesize($filename));
            echo $stream . PHP_EOL;
            $stream = json_decode($stream);
        }
        else
        {
            $stream = array();
        }
    }
    
    fclose($fp);

    return $stream;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    ListarAlumnos('../ListadoAlumnos.json');
}
?>