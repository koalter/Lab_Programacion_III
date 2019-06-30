<?php

namespace Clases;

use Clases\AccesoDatos;

class Pedido {
    public $id;
    public $cliente;
    public $articuloId;
    public $articuloTipo;
    public $cantidad;
    public $estado;
    //public $tiempoEstimado;
    //public $foto;

    public function CargarPedido($request, $response, $args) {
        $dao = AccesoDatos::dameUnObjetoAcceso();
        $articulo = new \Clases\Articulo();
        $archivos = $request->getUploadedFiles();

        $articulo->getArticulo($request->getParsedBody()['articulo']);

        $tiempo = new \DateTime(null, new \DateTimeZone('America/Argentina/Buenos_Aires'));
        $tiempo->add(new \DateInterval('PT'.$request->getParsedBody()['tiempo'].'M'));

        $query = $dao->RetornarConsulta("INSERT INTO pedidos 
            (nombreCliente, articulo, articuloTipo, cantidad, tiempoEstimado, fotoMesa)
            values (:nombreCliente, :articulo, :articuloTipo, :cantidad, :tiempoEstimado, :fotoMesa)");
        $query->bindValue(":nombreCliente", $request->getParsedBody()['cliente']);
        $query->bindValue(":articulo", $articulo->descripcion);
        $query->bindValue(":articuloTipo", $articulo->tipo);
        $query->bindValue(":cantidad", $request->getParsedBody()['cantidad']);
        $query->bindValue(":tiempoEstimado", $tiempo->format('Y-m-d H:i:s'));
        $query->bindValue(":fotoMesa", isset($archivos['foto']) ? $archivos['foto']->getClientFileName() : null);

        $query->execute();

        return $response->withJson($dao->RetornarUltimoIdInsertado(), 200);
    }

    private function ModificarEstado($id, $estado) {
        $dao = AccesoDatos::dameUnObjetoAcceso();
        $estadoActual = $estado - 1;

        $query = $dao->RetornarConsulta("UPDATE pedidos SET estado = $estado WHERE id = $id AND estado = $estadoActual");

        $query->execute();

        return $response->withJson('exito', 200);
    }

    public function EntregarPedido($request, $response, $args) {
        return ModificarEstado($request->getParsedBody()['id'], 1);
    }

    public function ServirPedido($request, $response, $args) {
        return ModificarEstado($request->getParsedBody()['id'], 2);
    }
}

?>