<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './composer/vendor/autoload.php';
require './Clases/AccesoDatos.php';
require './Clases/EmpleadoApi.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$VerificadorDeCredenciales = function ($request, $response, $next) {

  if($request->isGet())
  {
    $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
    $response = $next($request, $response);
  }
  else
  {
    $response->getBody()->write('<p>verifico credenciales</p>');
    $ArrayDeParametros = $request->getParsedBody();
    $nombre=$ArrayDeParametros['nombre'];
    $tipo=$ArrayDeParametros['tipo'];
    if($tipo=="administrador")
    {
      $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
      $response = $next($request, $response);
    }
    else
    {
      $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
    }  
  }  
  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
  // $response->getBody()->write($request->getMethod());
  return $response;
};
/*
$app->group('[/]', function () {
 
  $this->get('/', \EmpleadoApi::class . ':TraerTodos');
 
  $this->get('/{id}', \EmpleadoApi::class . ':TraerUno');

  $this->post('/', \EmpleadoApi::class . ':CargarUno');

  $this->delete('/', \EmpleadoApi::class . ':BorrarUno');

  $this->put('/', \EmpleadoApi::class . ':ModificarUno');
  
})->add($VerificadorDeCredenciales);
*/
$app->group('/Empleado', function () {
 
  $this->get('/', \EmpleadoApi::class . ':TraerTodos');
 
  $this->get('/{id}', \EmpleadoApi::class . ':TraerUno');

  $this->post('/', \EmpleadoApi::class . ':CargarUno');

  $this->delete('/', \EmpleadoApi::class . ':BorrarUno');

  $this->put('/', \EmpleadoApi::class . ':ModificarUno');
  
})->add($VerificadorDeCredenciales);

$app->add(function ($request, $response, $next) {
  $response->getBody()->write('<p>Antes de ejecutar UNO </p>');
  $response = $next($request, $response);
  $response->getBody()->write('<p>Despues de ejecutar UNO</p>');

  return $response;
});

$app->add(function ($request, $response, $next) {
  $response->getBody()->write('<p>Antes de ejecutar DOS </p>');
  $response = $next($request, $response);
  $response->getBody()->write('<p>Despues de ejecutar DOS</p>');

  return $response;
});

$app->run();
 ?>