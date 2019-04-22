<?php

class Pedido
{
    public $producto;
    public $cantidad;
    public $idProveedor;
    //public $nombreProveedor;

    public function Constructor($producto, $cantidad, $idProveedor)
    {
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->idProveedor = $idProveedor;
    }

    public function HacerPedido($producto, $cantidad, $idProveedor)
    {
        
    }
}

?>