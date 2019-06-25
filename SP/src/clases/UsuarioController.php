<?php 
require_once 'IApiUsable.php';
require_once 'Usuario.php';

class UsuarioController extends Usuario implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		return Usuario::TraerUnUsuarioPorLegajo($request->getParsedBody()['nombre']);
	}
	public function TraerUnoPorNombreId($request, $response, $args) {
		return Usuario::TraerUnUsuarioIdNombre($request->getParsedBody()['legajo'], $request->getParsedBody()['nombre']);
	}
	public function CargarUno($request, $response, $args) {

		$usuario = Usuario::new_Usuario($request, $response, $args);

		$dao = AccesoDatos::dameUnObjetoAcceso();
		$query = $dao->RetornarConsulta("INSERT INTO usuarios (nombre, clave, tipo) 
			VALUES (:nombre, :clave, :tipo)");
		$query->bindValue(':nombre', $usuario->nombre, PDO::PARAM_STR);
		$query->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
		$query->bindValue(':tipo', $usuario->tipo, PDO::PARAM_STR);

		$query->execute();

		$id = $dao->RetornarUltimoIdInsertado();
        $usuarioRegistrado = Usuario::TraerUnUsuarioIdNombre($id, $usuario->nombre);

        return $response->withJson($usuarioRegistrado, 200);
	}
}

?>