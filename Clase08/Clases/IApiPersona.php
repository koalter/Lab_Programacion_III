<?php

interface IApiPersona {
    public function GuardarUno($request, $response, $args);
    public function BorrarUno($request, $response, $args);
    public function ModificarUno($request, $response, $args);
    public function TraerTodos($request, $response, $args);
    public function TraerUno($request, $response, $args);
}

?>