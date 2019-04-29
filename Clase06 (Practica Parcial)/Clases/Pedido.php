<?php

class Pedido
{
    public $producto;
    public $cantidad;
    public $idProveedor;
    //public $nombreProveedor;

    // public function Constructor($producto, $cantidad, $idProveedor)
    // {
    //     $this->producto = $producto;
    //     $this->cantidad = $cantidad;
    //     $this->idProveedor = $idProveedor;
    // }

    public function __construct($producto, $cantidad, $idProveedor)
    {
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->idProveedor = $idProveedor;
    }

    public static function hacerPedido($fproveedores, $fpedidos)
    {
        $proveedores = Proveedor::proveedores($fproveedores);

        if (Proveedor::consultarProveedorPorId($proveedores))
        {
            $pedidos = Pedido::listarPedidos($fpedidos);

            $file = fopen($fpedidos, "w");
            $dummy = new Pedido($_POST['producto'], $_POST['cantidad'], $_POST['idProveedor']);
            $pedidos[] = $dummy;
    
            foreach ($pedidos as $pedido)
            {
                $string = $pedido->producto . " " . $pedido->cantidad . " " . $pedido->idProveedor . PHP_EOL;
                fwrite($file, $string);
            }

            fclose($file);
        }
        else 
        {
            $dummy = "No existe el id " . $_POST['idProveedor'];
        }

        return $dummy;
    }

    public static function listarPedidos($filename)
    {
        $pedidos = array();
        $file = fopen($filename, "r");
        
        if ($file)
        {
            while (!feof($file))
            {
                $object = fscanf($file, "%s %s %s\n");
                // var_dump($object);
                if ($object)
                {
                    $dummy = new Pedido($object[0], $object[1], $object[2]);
                    $pedidos[] = $dummy;
                    // var_dump($dummy);
                }
            }
            // var_dump($pedidos);

            fclose($file);
        }

        return $pedidos;
    }

    public static function listarPedidoProveedor($filename)
    {
        $retorno = array();
        $flag = false;
        
        if ($_GET['idProveedor'] != null)
        {
            $pedidos = Pedido::listarPedidos($filename);
            
            foreach ($pedidos as $pedido)
            {
                if ($_GET['idProveedor'] == $pedido->idProveedor)
                {
                    $retorno[] = $pedido;
                }
            }
        }
        
        return $retorno;
    }
}

?>