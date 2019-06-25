<?php
class Materia {
	public $nombre;
	public $cuatrimestre;
	public $cupos;

	public static function new_Materia($request, $response, $args) {
		$materia = new Materia();
    	$materia->nombre = $request->getParsedBody()['nombre'];
    	$materia->cuatrimestre = $request->getParsedBody()['cuatrimestre'];
    	$materia->cupos = $request->getParsedBody()['cupos'];

    	return $materia;
	}

	public static function TraerUnaMateriaIdNombre($id, $nombre) {
		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("SELECT nombre, cuatrimestre, cupos FROM materias 
			WHERE id = $id AND nombre = '$nombre'");
		$query->execute();
		return $query->fetchObject('Materia');
	}

	public static function TraerUnaMateriaPorId($id) {
		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("SELECT nombre, cuatrimestre, cupos FROM materias 
			WHERE id = $id");
		$query->execute();
		return $query->fetchObject('Materia');
	}

	public function ModificarCupos() {

		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("UPDATE materias SET cupos = $this->cupos
			WHERE nombre = '$this->nombre' AND cuatrimestre = $this->cuatrimestre");
		$query->execute();
	}
}

?>