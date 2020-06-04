<?php
header("Content-Type: application/json");
include_once("../class/class-promocion.php");
include_once("../class/class-empresa.php");
include_once("../class/class-usuario.php");
include_once("../class/class-cliente.php");
include_once("../api/upload.php");
//$_POST = json_decode(file_get_contents('php://input'), true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'registro':
                    $usuario = new Usuario();
                    if ($usuario->verificarAutenticacionEmpresa()) {
                        $empresa = new Empresa();
                        $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        $imagenesValidas = true;
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["imagenPromocion"]);
                        $respuesta["valido"] = $imagenesValidas;
                        if ($respuesta["valido"]) {
                            $promocion = new Promocion();
                            $promocion->setTodo(
                                $_POST["nombrePromocion"],
                                $_POST["descripcionPromocion"],
                                SubidaImagen::RUTA_PROMOCION . $_FILES["imagenPromocion"]["name"],
                                $_POST["selectProducto"],
                                $_POST["descuento"],
                                $_POST["precioNormal"],
                                $_POST["precioOferta"],
                                $_POST["fechaVencimiento"],
                                $_POST["fechaInicio"],
                                $empresa->getIdEmpresa(),
                                $_POST["selectSucursal"],
                            );
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_PROMOCION_SUBIDA, $_FILES["imagenPromocion"]);
                            $promocion->guardarPromocion();
                            echo json_encode($respuesta);
                        } else {
                            $respuesta["valido"] = false;
                            echo json_encode($respuesta);
                        }
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
            }
        }
        break;
    case 'GET':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
               
                }
            }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}
