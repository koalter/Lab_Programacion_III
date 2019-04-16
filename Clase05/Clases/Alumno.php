<?php

class Alumno
{
    public $Id;
    public $Apellido;
    public $Legajo;
    public $IdLocalidad;

    // Muestra a todos los alumnos en la base de datos
    public static function TraerTodosLosAlumnos()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM alumno");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");		
    }

    // Metodo constructor, externo del metodo __construct() por defecto
    public function Constructor($Apellido, $Legajo, $IdLocalidad)
    {
        $this->$Apellido = $Apellido;
        $this->$Legajo = $Legajo;
        $this->$IdLocalidad = $IdLocalidad;
    }

    // Inserta un registro de Alumno en la base de datos
    public function Insertar()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into alumno (Apellido, Legajo, IdLocalidad) values ('$this->Apellido','$this->Legajo','$this->IdLocalidad')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    // Guarda un array de alumnos en un archivo
    public function Guardar()
    {

    }
}

?>