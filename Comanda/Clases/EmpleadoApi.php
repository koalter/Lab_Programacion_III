<?php 
require_once 'Empleado.php';
require_once 'IApiUsable.php';

class EmpleadoApi extends Empleado implements IApiUsable {

	public function CargarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre = $ArrayDeParametros['nombre'];
        $idRol = $ArrayDeParametros['idRol'];

        $empleado = new Empleado();
        $empleado->nombre = $nombre;
        $empleado->idRol = $idRol;
        $empleado->GuardarEmpleado();

        $response->getBody()->write("Se guardo el empleado!");

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
        $empleado = Persona::TraerUnEmpleado($id);
        $newResponse = $response->withJson($empleado, 200);  
        return $newResponse;
    }

    public function TraerTodos($request, $response, $args) {
        $listEmpleado = Empleado::TraerTodosLosEmpleados();
     	$newResponse = $response->withJson($listEmpleado, 200);
     	// $newResponse = "hasta aca llego";
    	return $newResponse;
    }
}


 ?>