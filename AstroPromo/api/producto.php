<?php


header("Content-Type: application/json");
include_once("../class/class-producto.php");
include_once("../class/class-empresa.php");
include_once("../class/class-usuario.php");
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
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["foto-Producto"]);
                        $respuesta["valido"] = $imagenesValidas;
                        if ($respuesta["valido"]) {
                            $producto = new Producto();
                            $producto->setTodo(
                                $_POST['nombreProducto'],
                                $_POST['descripcionProducto'],
                                $_POST['precioProducto'],
                                SubidaImagen::RUTA_PRODUCTO . $_FILES["foto-Producto"]["name"],
                                $empresa->getIdEmpresa()
                            );
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_PRODUCTO_SUBIDA, $_FILES["foto-Producto"]);
                            $producto->guardarProducto();
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
