<?php

class Alumno
{
    public $apellido;
    public $legajo;

    function __construct($apellido, $legajo)
    {
        $this->apellido = $apellido;
        $this->legajo = $legajo;
    }
}
?>