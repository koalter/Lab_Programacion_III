<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../composer/vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/PersonaApi.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/MWparaCORS.php';
require_once '/clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/Persona', function () {
 
  $this->get('/', \PersonaApi::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
 
  $this->get('/{id}', \PersonaApi::class . ':traerUno')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->post('/', \PersonaApi::class . ':CargarUno');

  $this->delete('/', \PersonaApi::class . ':BorrarUno');

  $this->put('/', \PersonaApi::class . ':ModificarUno');
     
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');



$app->run();