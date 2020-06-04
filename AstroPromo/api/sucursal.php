<?php
header("Content-Type: application/json");
include_once("../class/class-sucursal.php");
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
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["foto-Sucursal"]);
                        $respuesta["valido"] = $imagenesValidas;
                        if ($respuesta["valido"]) {
                            $sucursal = new Sucursal();
                            $sucursal->setTodo(
                                $_POST['codigoSucursal'],
                                $_POST['direccionSucursal'],
                                $_POST['longitud'],
                                $_POST['latitud'],
                                SubidaImagen::RUTA_SUCURSAL . $_FILES["foto-Sucursal"]["name"],
                                $empresa->getIdEmpresa()
                            );
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_SUCURSAL_SUBIDA, $_FILES["foto-Sucursal"]);
                            $sucursal->guardarSucursal();
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
