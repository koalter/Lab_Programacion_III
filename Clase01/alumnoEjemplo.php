<?php
//Las clases se definen igual que en cualquier otro lenguaje OOP
class AlumnoEjemplo
{
    public $nombre;
    public $edad;

    //TODO: chequear constructores
    function __construct($nombre, $edad){
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    function retornarJson() {
        echo json_encode($this);
    }
}
?>