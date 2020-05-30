<?php
header("Content-Type: application/json");
include_once("../class/class-usuario.php");
include_once("../class/class-cliente.php");
include_once("../class/class-empresa.php");
include_once("../api/upload.php");

//$_POST = json_decode(file_get_contents('php://input'), true);


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'login':
                    $usuario = new Usuario();
                    $respuesta = $usuario->login($_POST['correo'], $_POST['contrasena']);
                    echo json_encode($respuesta);
                    break;
                case 'registro':
                    $tipo = $_GET['tipo'];
                    $imagenesValidas = true;
                    if ($tipo == 'cliente') {
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["fotoPerfil"]);
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["fotoPortada"]);
                    } else {
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["logotipo"]);
                        $imagenesValidas = SubidaImagen::verificarExtension($_FILES["banner"]);
                    }
                    $respuesta["valido"] = $imagenesValidas;
                    if ($respuesta["valido"]) {
                        $usuario = new Usuario();
                        $usuario->setTodo(
                            $_POST['correo'],
                            $_POST['cliente'] = ($tipo == 'cliente'),
                            $_POST['empresa'] = ($tipo == 'empresa'),
                            false,
                            $_POST['contrasena'],
                            ''
                        );
                        $respuesta = $usuario->registro($_POST['confirmacionContrasena']);
                    } else {
                        $respuesta["mensaje"] = "Extensiones de archivos no validas(Admitidos: jpg/jpeg/png)";
                    }

                    if ($respuesta["valido"]) {

                        switch ($_GET['tipo']) {
                            case 'cliente':
                                $cliente = new Cliente();
                                $cliente->setTodo(
                                    $_POST['nombre'],
                                    $_POST['apellido'],
                                    $_POST['fechaNacimiento'],
                                    SubidaImagen::RUTA_PERFIL . $_FILES["fotoPerfil"]["name"],
                                    $_POST['genero'],
                                    $_POST['numeroTelefono'],
                                    $_POST['numeroTarjeta'],
                                    SubidaImagen::RUTA_PORTADA . $_FILES["fotoPortada"]["name"],
                                    $_POST['refIdUsuario'] = $usuario->getIdUsuario()
                                );
                                SubidaImagen::subirFoto(SubidaImagen::RUTA_PERFIL_SUBIDA, $_FILES["fotoPerfil"]);
                                SubidaImagen::subirFoto(SubidaImagen::RUTA_PORTADA_SUBIDA, $_FILES["fotoPortada"]);
                                $cliente->guardarCliente();
                                break;
                            case 'empresa':
                                $empresa = new Empresa();
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
                                $empresa->guardarEmpresa();
                                break;
                        }
                        echo json_encode($respuesta);
                    } else {
                        echo json_encode($respuesta);
                    }
                    break;
            }
        }
        break;
    case 'GET':
        if (isset($_GET['accion']) && $_GET['accion'] == 'logout')
            Usuario::logout();
        exit();
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
