<?php
header("Content-Type: application/json");
include_once("../class/class-cliente.php");
include_once("../class/class-usuario.php");
include_once("../class/class-empresa.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

        break;
    case 'GET':
        if (isset($_GET['accion'])) {
            $usuario = new Usuario();
            $cliente = new Cliente();
            switch ($_GET['accion']) {
                case 'perfil':
                    if ($usuario->verificarAutenticacionCliente()) {
                        $respuesta = $cliente->obtenerCliente($usuario->getIdUsuario());
                        if ($respuesta["valido"]) {
                            $respuesta["nombre"] = $cliente->getNombre();
                            $respuesta["apellido"] = $cliente->getApellido();
                            $respuesta["fechaNacimiento"] = $cliente->getFechaNacimiento();
                            $respuesta["fotoPerfil"] = $cliente->getFotoPerfil();
                            $respuesta["genero"] = $cliente->getGenero();
                            $respuesta["numeroTelefono"] = $cliente->getNumeroTelefono();
                            $respuesta["numeroTarjeta"] = $cliente->getNumeroTarjeta();
                            $respuesta["fotoPortada"] = $cliente->getFotoPortada();
                            $respuesta["correo"] = $usuario->getCorreo();
                        }
                        echo json_encode($respuesta);
                    } else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                    break;
                case 'empresasSeguidas':
                    if ($usuario->verificarAutenticacionCliente()) {
                        $cliente->obtenerCliente($usuario->getIdUsuario());
                        $respuesta = $cliente->empresasSeguidas();
                        $empresasJson=array();
                        foreach ($respuesta["empresas"] as &$empresa){
                            $empresasJson[]= json_encode($empresa->comoArreglo());
                        }
                        $respuesta["empresas"]=$empresasJson;
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
