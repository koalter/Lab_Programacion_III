<?php

class Persona {
    public $id;
    public $nombre;
    public $edad;
    public $CreateDttm;

    public static GuardarAlumno() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into persona(nombre, edad) values(:nombre,:edad)");
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}
?>