<?php
include "Humano.php";

class Persona extends Humano
{
    public $dni;
    
    function RetornaJson()
    {
        parent::RetornarJson();
    }

    function __construct($nombre, $edad, $dni)
    {
        parent::__construct($nombre, $edad);
        $this->dni = $dni;
    }
}

?>