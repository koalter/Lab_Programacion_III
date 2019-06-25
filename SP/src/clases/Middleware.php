<?php 
class Middleware {

	public function verificarUsuarioAdmin($request, $response, $next) {
		if ($request->getHeader('perfil')[0] == 'admin')
			$response = $next($request, $response);
		else
			$response->getBody()->write("hola");

		return $response;
	}

	public function verificarJWT($request, $response, $next) {
		$token = $request->getHeader('token')[0];

		AutentificadorJWT::VerificarToken($token);
		$response = $next($request, $response);
		return $response;
	}

	public function verificarJWTAdmin($request, $response, $next) {
		$token = $request->getHeader('token')[0];

		AutentificadorJWT::VerificarTokenAdmin($token);
		$response = $next($request, $response);
		return $response;
	}

	public function verificarJWTProfe($request, $response, $next) {
		$token = $request->getHeader('token')[0];

		AutentificadorJWT::VerificarTokenProfesor($token);
		$response = $next($request, $response);
		return $response;
	}

	public function verificarJWTAlumno($request, $response, $next) {
		$token = $request->getHeader('token')[0];

		AutentificadorJWT::VerificarTokenAlumno($token);
		$response = $next($request, $response);
		return $response;
	}

	public function verificarQueElUsuarioExiste($request, $response, $next) {
		$miUsuario = Usuario::TraerUnUsuarioPorNombre($request->getParsedBody()['usuario']);
		
		if ($miUsuario)
			$response = $next($request, $response);

		return $response;
	}

	public function generarLog($request, $response, $next) {
		$dao = AccesoDatos::dameUnObjetoAcceso();
		$metodo = $request->getMethod();
		if ($metodo == 'GET')
			$usuario = $request->getHeader('usuario')[0];
		else if ($metodo == 'POST')
			$usuario = $request->getParsedBody()['usuario'];
		$ruta = $request->getUri();
		$queryString = "INSERT INTO logs (usuario, metodo, ruta) VALUES (:usuario, :metodo, :ruta)";

		// var_dump($metodo . PHP_EOL);
		// var_dump($usuario . PHP_EOL);
		// var_dump($ruta . PHP_EOL);

		$query = $dao->RetornarConsulta($queryString);
		$query->bindValue(':usuario', $usuario, PDO::PARAM_STR);
		$query->bindValue(':metodo', $metodo, PDO::PARAM_STR);
		$query->bindValue(':ruta', $ruta, PDO::PARAM_STR);

		$query->execute();

		$response = $next($request, $response);

		return $response;
	}
}

?>