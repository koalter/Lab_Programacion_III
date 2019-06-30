<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Clases\Empleado;
use Clases\Pedido;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/pedido', function () use ($container) {

        $this->post('/armar', function (Request $request, Response $response, array $args) {
            return Pedido::CargarPedido($request, $response, $args);
        });

        $this->post('/entregar', function (Request $request, Response $response, array $args) {
            return Pedido::EntregarPedido($request, $response, $args);
        });

        $this->post('/servir', function (Request $request, Response $response, array $args) {
            return Pedido::ServirPedido($request, $response, $args);
        });
    });
};
