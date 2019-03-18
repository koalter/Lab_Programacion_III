<?php
//Las clases se definen igual que en cualquier otro lenguaje OOP
class Alumno
{
    public $nombre;
    public $edad;

    function retornarJson() {
        echo json_encode($this);
    }
}
?>
