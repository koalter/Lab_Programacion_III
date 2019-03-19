<?php
class Humano
{
    public $nombre;
    public $edad;

    function RetornarJson()
    {
        echo json_encode($this);
    }

    function __construct($nombre, $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}

?>