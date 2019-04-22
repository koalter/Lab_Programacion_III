<?php
include ("./Clases/Proveedor.php");
include ("./Clases/Pedido.php");

$mensaje = "";
$metodo = $_SERVER['REQUEST_METHOD'];
$proveedor = new Proveedor();
$pedido = new Pedido();

switch ($metodo)
{
    case 'POST':
        switch ($_POST['caso'])
        {
            case 'cargarProveedor':
                $proveedor->Constructor($_POST['id'], $_POST['nombre'], $_POST['email'], $_POST['foto']);
                $mensaje = $proveedor->Guardar();
                break;
            case 'hacerPedido':
                $pedido->HacerPedido($_POST['producto'], $_POST['cantidad'], $_POST['idProveedor']);
                break;
            default:
                $mensaje = 'Usar la propiedad "caso" con el valor "cargarProveedor"';
                break;
        }
        break;
    case 'GET':
        switch ($_POST['caso'])
        {
            case 'consultarProveedor':
                $mensaje = $entidad->Consultar();
                break;
            case 'proveedores':
                $mensaje = $entidad->Listar();
                break;
            default:
                $mensaje = 'Usar la propiedad "caso" con el valor "consultarProveedor" o "proveedores"';
                break;
        }
        break;
}

echo $mensaje;

?>