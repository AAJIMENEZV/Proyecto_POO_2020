<?php
header("Content-Type: application/json");
include_once("../class/class-empresa.php");
include_once("../class/class-usuario.php");
include_once("../class/class-seguidor.php");
include_once("../class/class-cliente.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'seguir':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    $seguidor = new Seguidor();
                    $cliente = new Cliente();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerEmpresaPorId();
                        if ($respuesta["valido"]) {
                            $cliente->obtenerCliente($usuario->getIdUsuario());
                            $seguidor->setIdCliente($cliente->getIdCliente());
                            $seguidor->setIdEmpresa($empresa->getIdEmpresa());
                            $seguido = $seguidor->obtenerSeguidorPorIdClienteIdEmpresa();
                            if ($seguido) {
                                $seguidor->eliminarSeguidor();
                            } else {
                                $seguidor->setFechaSeguidor(date("Y-m-d"));
                                $seguidor->guardarSeguidor();
                            }
                            $respuesta["seguido"] = !$seguido;
                        }
                        echo json_encode($respuesta);
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
                case 'perfil':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionEmpresa()) {
                        $respuesta = $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        if ($respuesta["valido"]) {
                            $respuesta["nombreEmpresa"] = $empresa->getNombreEmpresa();
                            $respuesta["pais"] = $empresa->getPais();
                            $respuesta["direccion"] = $empresa->getDireccion();
                            $respuesta["logotipo"] = $empresa->getLogotipo();
                            $respuesta["telefono"] = $empresa->getTelefono();
                            $respuesta["banner"] = $empresa->getBanner();
                            $respuesta["redesSociales"] = $empresa->getRedesSociales();
                            $respuesta["correo"] = $usuario->getCorreo();
                        }
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
                case 'productos':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionEmpresa()) {
                        $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        $respuesta = $empresa->obtenerProductos();
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                    break;
                case 'sucursales':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionEmpresa()) {
                        $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        $respuesta = $empresa->obtenerSucursales();
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                    break;
                case 'promociones':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionEmpresa()) {
                        $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        $respuesta = $empresa->obtenerPromociones();
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                    break;
                case 'perfilVista':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerEmpresaPorId();
                        if ($respuesta["valido"]) {
                            $respuesta["nombreEmpresa"] = $empresa->getNombreEmpresa();
                            $respuesta["pais"] = $empresa->getPais();
                            $respuesta["direccion"] = $empresa->getDireccion();
                            $respuesta["logotipo"] = $empresa->getLogotipo();
                            $respuesta["telefono"] = $empresa->getTelefono();
                            $respuesta["banner"] = $empresa->getBanner();
                            $respuesta["redesSociales"] = $empresa->getRedesSociales();
                            $usuario->setIdUsuario($empresa->getIdUsuario());
                            $usuario->obtenerUsuarioPorId();
                            $respuesta["correo"] = $usuario->getCorreo();
                        }
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
                case 'promocionesVista':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerPromociones();
                        $respuesta["valido"] = true;
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
                case 'productosVista':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerProductos();
                        $respuesta["valido"] = true;
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
                case 'sucursalesVista':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerSucursales();
                        $respuesta["valido"] = true;
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;

                case 'verificarSeguido':
                    $usuario = new Usuario();
                    $empresa = new Empresa();
                    $seguidor = new Seguidor();
                    $cliente = new Cliente();
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->setIdEmpresa($_GET["id"]);
                        $respuesta = $empresa->obtenerEmpresaPorId();
                        if ($respuesta["valido"]) {
                            $cliente->obtenerCliente($usuario->getIdUsuario());
                            $seguidor->setIdCliente($cliente->getIdCliente());
                            $seguidor->setIdEmpresa($empresa->getIdEmpresa());
                            $seguido = $seguidor->obtenerSeguidorPorIdClienteIdEmpresa();
                            $respuesta["seguido"] = $seguido;
                        }
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }

                    break;
            }
        }
        break;
    case 'PUT':
        if (isset($_GET['accion'])) {
            $usuario = new Usuario();
            $empresa = new Empresa();
            switch ($_GET['accion']) {
                case 'actualizarEmpresa':
                    if ($usuario->verificarAutenticacionCliente()) {
                        $empresa->obtenerEmpresa($usuario->getIdUsuario());
                        $imagenesValidas = true;
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["logotipo"]);
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["banner"]);
                        $respuesta["valido"] = $imagenesValidas;
                        if ($respuesta["valido"]) {
                            $empresa->setTodo(
                                $_POST['nombreEmpresa'],
                                    $_POST['pais'],
                                    $_POST['direccion'],
                                    SubidaImagen::RUTA_LOGOTIPO . $_FILES["logotipo"]["name"],
                                    $_POST['telefono'],
                                    SubidaImagen::RUTA_BANNER . $_FILES["banner"]["name"],
                                    $_POST['redesSociales'],
                                    $_POST['refIdUsuario'] = $usuario->getIdUsuario()
                            );
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_LOGOTIPO_SUBIDA, $_FILES["logotipo"]);
                                SubidaImagen::subirFoto(SubidaImagen::RUTA_BANNER_SUBIDA, $_FILES["banner"]);
                                $empresa->actualizarEmpresa();
                        }
                    }else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                break;
            }
        }
        break;
    case 'DELETE':
        break;
}
