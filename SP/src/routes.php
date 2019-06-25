<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
	$container = $app->getContainer();

	$app->post('/usuario[/]', function (Request $request, Response $response, array $args) use ($container) {
		return UsuarioController::CargarUno($request, $response, $args);
	});

	$app->post('/login[/]', function(Request $request, Response $response, array $args) use ($container) {
        $usuario = UsuarioController::TraerUnoPorNombreId($request, $response, $args);

		if ($usuario)
			return $response->withJson(AutentificadorJWT::CrearToken($usuario), 200);
		else
			return $response->getBody()->write('Ingresaste mal los datos');
    });

    $app->post('/materia[/]', function(Request $request, Response $response, array $args) use ($container) {
		return MateriaController::CargarUno($request, $response, $args);
    })->add(\Middleware::class . ':verificarJWTAdmin');

    $app->post('/usuario/{legajo}', function(Request $request, Response $response, array $args) use ($container) {
    	$usuario = Usuario::TraerUnUsuarioPorLegajo($args['legajo']);
    	$token = $request->getHeader('token')[0];
    	
    	if ($usuario)
    	{
    		if (AutentificadorJWT::ObtenerData($token)->tipo == 'admin')
	    	{
	    		$usuario->AgregarEmail($request, $response, $args);
	    		$usuario->AgregarFoto($request, $response, $args);
	    		$usuario->AgregarMaterias($request, $response, $args);
	    	}
    		else if ($usuario->tipo == 'alumno' && AutentificadorJWT::ObtenerData($token)->tipo == 'alumno')
	    	{
	    		$usuario->AgregarEmail($request, $response, $args);
	    		$usuario->AgregarFoto($request, $response, $args);
	    	}
	    	else if ($usuario->tipo == 'profesor' && AutentificadorJWT::ObtenerData($token)->tipo == 'profesor')
	    	{
	    		$usuario->AgregarEmail($request, $response, $args);
	    		$usuario->AgregarMaterias($request, $response, $args);
	    	}
	    	else
	    	{
	    		return $response->getBody()->write("El legajo y el token no coinciden");
	    	}

	    	return $response->withJson($usuario, 200);
    	}
    	
    	else
    		return $response->getBody()->write("No existe el usuario");
    })->add(\Middleware::class . ':verificarJWT');

    $app->post('/inscripcion/{idMateria}', function(Request $request, Response $response, array $args) use ($container) {
    	$usuario = Usuario::TraerUnUsuarioPorLegajo($request->getParsedBody()['legajo']);
    	$materia = Materia::TraerUnaMateriaPorId($args['idMateria']);

    	if ($materia->cupos > 0 && $usuario->tipo == 'alumno')
    	{
    		$usuario->materias = $materia->nombre;
    		$materia->cupos = $materia->cupos - 1;
    		$materia->ModificarCupos();

    		return $response->getBody()->write("quedan $materia->cupos cupos");
    	}
    	else if ($usuario->tipo != 'alumno')
    	{
    		return $response->getBody()->write("El legajo no corresponde a un alumno");
    	}
    	else
    	{
    		return $response->getBody()->write("NO QUEDAN CUPOS");
    	}
    })->add(\Middleware::class . ':verificarJWTAlumno');
};
