<?php

namespace Clases;

class Articulo {

    public $id;
    public $tipo;
    public $descripcion;

    public function getArticulo($articulo) {
        $dao = AccesoDatos::dameUnObjetoAcceso();
        $query = $dao->RetornarConsulta("SELECT id, tipo, descripcion FROM articulos WHERE descripcion = '$articulo'");
        $query->execute();
        
        $result = $query->fetchObject('\Clases\Articulo');

        $this->id = $result->id;
        $this->tipo = $result->tipo;
        $this->descripcion = $result->descripcion;
    }
}