<?php 

interface IApiUsable{ 
	
   	public function TraerUno($request, $response, $args); 
   	public function TraerUnoPorNombreId($request, $response, $args);
   	public function CargarUno($request, $response, $args);

}