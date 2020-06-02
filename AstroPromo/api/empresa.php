<?php
header("Content-Type: application/json");
include_once("../class/class-empresa.php");
include_once("../class/class-usuario.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

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
                    }
            }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
}
