<?php
require_once 'Persona.php';
require_once 'IApiPersona.php';

// Aca va la lógica de negocio
class PersonaApi extends Persona implements IApiPersona {

    public function GuardarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre = $ArrayDeParametros['nombre'];
        $edad = $ArrayDeParametros['edad'];

        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->GuardarPersona();

        $response->getBody()->write("Se guardo la persona!");

        return $response;
    }

    public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
     	$id = $ArrayDeParametros['id'];
     	$persona = new Persona();
     	$persona->id = $id;
     	$cantidadDeBorrados = $persona->BorrarPersona();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad = $cantidadDeBorrados;
	    if($cantidadDeBorrados > 0)
        {
            $objDelaRespuesta->resultado="algo borro!!!";
        }
        else
        {
            $objDelaRespuesta->resultado="no Borro nada!!!";
        }
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }

    public function ModificarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id = $ArrayDeParametros['id'];
        $nombre = $ArrayDeParametros['nombre'];
        $edad = $ArrayDeParametros['edad'];

        $persona = new Persona();
        $persona->id = $id;
        $persona->nombre = $nombre;
        $persona->edad = $edad;

        $resultado = $persona->ModificarCdParametros();
        $objDelaRespuesta = new stdclass();
        //var_dump($resultado);
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200); 
    }

    public function TraerUno($request, $response, $args) {
        $id = $args['id'];
        $persona = Persona::TraerUnaPersona($id);
        $newResponse = $response->withJson($persona, 200);  
        return $newResponse;
    }

    public function TraerTodos($request, $response, $args) {
        $listPersona = Persona::TraerTodasLasPersonas();
     	$newResponse = $response->withJson($listPersona, 200);  
    	return $newResponse;
    }
}

?>