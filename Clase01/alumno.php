<?php
include "Persona.php";

class Alumno extends Persona
{
    public $legajo;
    
    function RetornarJson()
    {
        parent::RetornarJson();
    }

    function __construct($nombre, $edad, $dni, $legajo)
    {
        parent::__construct($nombre, $edad, $dni);
        $this->legajo = $legajo;
    }
}

?>