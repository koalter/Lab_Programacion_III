<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './composer/vendor/autoload.php';

$app = new \Slim\App([]);

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    return $response;

});
$app->post('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("POST => Bienvenido!!! ,a SlimFramework");
    return $response;

});
$app->delete('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("DELETE => Bienvenido!!! ,a SlimFramework");
    return $response;

});
$app->put('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("PUT => Bienvenido!!! ,a SlimFramework");
    return $response;

});


$app->group('/persona', function () {
 
    // $this->get('/', \PersonaApi::class . ':traerTodos');
   
    // $this->get('/{id}', \PersonaApi::class . ':traerUno');
  
    $this->post('/', \PersonaApi::class . ':GuardarUno');
  
    // $this->delete('/', \PersonaApi::class . ':BorrarUno');
  
    // $this->put('/', \PersonaApi::class . ':ModificarUno');
       
  });

$app->run();
?>