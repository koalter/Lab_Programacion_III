<?php
require_once 'IApiUsable.php';
require_once 'Materia.php';

class MateriaController extends Materia implements IApiUsable {
	public function TraerUno($request, $response, $args) {
		throw new Exception("Metodo no implementado");
	}
   	public function TraerUnoPorNombreId($request, $response, $args) {
   		throw new Exception("Metodo no implementado");
   	}
   	public function CargarUno($request, $response, $args) {
   		$materia = Materia::new_Materia($request, $response, $args);

		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("INSERT INTO materias (nombre, cuatrimestre, cupos) 
			VALUES ('$materia->nombre', $materia->cuatrimestre, $materia->cupos)");

		$query->execute();

		$id = $dao->RetornarUltimoIdInsertado();
        $materiaRegistrado = Materia::TraerUnaMateriaIdNombre($id, $materia->nombre);

        return $response->withJson($materiaRegistrado, 200);
   	}
}

?>