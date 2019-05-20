<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './composer/vendor/autoload.php';
require_once './Clases/PersonaApi.php';
require_once './Clases/AccesoDatos.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

// $app->get('[/]', function (Request $request, Response $response) {    
//     $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
//     return $response;

// });
// $app->post('[/]', function (Request $request, Response $response) {    
//     $response->getBody()->write("POST => Bienvenido!!! ,a SlimFramework");
//     return $response;

// });
// $app->delete('[/]', function (Request $request, Response $response) {    
//     $response->getBody()->write("DELETE => Bienvenido!!! ,a SlimFramework");
//     return $response;

// });
// $app->put('[/]', function (Request $request, Response $response) {    
//     $response->getBody()->write("PUT => Bienvenido!!! ,a SlimFramework");
//     return $response;

// });


$app->group('/Persona', function () {
 
    $this->get('/', \PersonaApi::class . ':TraerTodos');
   
    $this->get('/{id}', \PersonaApi::class . ':TraerUno');
  
    $this->post('/', \PersonaApi::class . ':GuardarUno');
  
    $this->delete('/', \PersonaApi::class . ':BorrarUno');
  
    $this->put('/', \PersonaApi::class . ':ModificarUno');
       
  });

$app->run();
?>