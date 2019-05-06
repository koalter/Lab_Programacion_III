<?php
require_once 'Persona.php';
require_once 'IApiPersona.php';

class PersonaApi extends Persona implements IApiPersona {

    public function GuardarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre = $ArrayDeParametros['nombre'];
        $edad = $ArrayDeParametros['edad'];

        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->GuardarAlumno();

        $response->getBody()->write("Se guardo la persona!");

        return $response;
    }
}

?>