<?php

class Empleado {
	
	public $id;
	public $nombre;
	public $idRol;

	public static function TraerTodosLosEmpleados() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, idRol FROM empleados");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");
	}
}

?>