<?php
header("Content-Type: application/json");
include_once("../class/class-cliente.php");
include_once("../class/class-usuario.php");
include_once("../class/class-empresa.php");
include_once("../class/class-promocion.php");
include_once("../api/upload.php");
//$_POST = json_decode(file_get_contents('php://input'),true);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            $usuario = new Usuario();
            $cliente = new Cliente();
            switch ($_GET['accion']) {
                case 'actualizarCliente':
                    if ($usuario->verificarAutenticacionCliente()) {
                        $cliente->obtenerCliente($usuario->getIdUsuario());
                        $imagenesValidas = true;
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["fotoPerfil"]);
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["fotoPortada"]);
                        $respuesta["valido"] = $imagenesValidas;
                        if ($respuesta["valido"]) {
                            $cliente->setTodo(
                                $_POST['nombre'],
                                $_POST['apellido'],
                                $_POST['fechaNacimiento'],
                                SubidaImagen::RUTA_PERFIL . $_FILES["fotoPerfil"]["name"],
                                $_POST['genero'],
                                $_POST['numerotelefono'],
                                $_POST['numeroTarjeta'],
                                SubidaImagen::RUTA_PORTADA . $_FILES["fotoPortada"]["name"],
                                $_POST['refIdUsuario'] = $usuario->getIdUsuario()
                            );
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_PERFIL_SUBIDA, $_FILES["fotoPerfil"]);
                            SubidaImagen::subirFoto(SubidaImagen::RUTA_PORTADA_SUBIDA, $_FILES["fotoPortada"]);
                            $cliente->actualizarCliente();
                        }
                        $respuesta["nombre"] = $cliente->getNombre();
                        $respuesta["apellido"] = $cliente->getApellido();
                        $respuesta["fechaNacimiento"] = $cliente->getFechaNacimiento();
                        $respuesta["fotoPerfil"] = $cliente->getFotoPerfil();
                        $respuesta["genero"] = $cliente->getGenero();
                        $respuesta["numeroTelefono"] = $cliente->getNumeroTelefono();
                        $respuesta["fotoPortada"] = $cliente->getFotoPortada();
                        echo json_encode($respuesta);
                    }else {
                        $respuesta["valido"] = false;
                        echo json_encode($respuesta);
                    }
                break;
            }
        }
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
                    case 'obtenerPromociones':
                        $promocion = new Promocion();
                        if ($usuario->verificarAutenticacionCliente()) {
                            $cliente->obtenerCliente($usuario->getIdUsuario());
                            $respuesta["promociones"] = $promocion->obtenerPromociones();
                            $respuesta["valido"]=true;
                            echo json_encode($respuesta);
                        }else{
                            $respuesta["valido"]=false;
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
