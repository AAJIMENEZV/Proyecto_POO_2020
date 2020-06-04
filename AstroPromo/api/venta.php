<?php
header("Content-Type: application/json");
include_once("../class/class-venta.php");
include_once("../class/class-promocion.php");
include_once("../class/class-usuario.php");
include_once("../class/class-cliente.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'compra':
                    $usuario = new Usuario();
                    $cliente = new Cliente();
                    $promocion = new Promocion();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $cliente->obtenerCliente($usuario->getIdUsuario());
                        $promocion->setIdPromocion($_POST["idPromocion"]);
                        $respuesta = $promocion->obtenerPromocionPorId();
                        
                        if ($respuesta["valido"]) {
                            $venta = new Venta();
                            $venta->setTodo(
                                $promocion->getIdPromocion(),
                                $promocion->getIdProducto(),
                                $cliente->getIdCliente(),
                                date("Y-m-d")
                            );
                            $venta->guardarVenta();
                        } 
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"]=false;
                        $respuesta["mensaje"]="Autentificacion invalida";
                        echo json_encode($respuesta);
                    }
                    break;
            }
        }
        break;
    case 'GET':
        if (isset($_GET[''])) {
        }
        if (isset($_GET[''])) {
        } else {
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}
