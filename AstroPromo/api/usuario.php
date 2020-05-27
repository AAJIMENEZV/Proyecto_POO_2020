<?php
header("Content-Type: application/json");
include_once("../class/class-usuario.php");
include_once("../class/class-cliente.php");
include_once("../class/class-empresa.php");
print_r($_POST);
//$_POST = json_decode(file_get_contents('php://input'), true);


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_GET['accion'])) {
            switch ($_GET['accion']) {
                case 'login':
                    $usuario = new Usuario();
                   echo $usuario->login($_POST['correo'], $_POST['contrasena']);
                    break;
                case 'registro':
                    $usuario = new Usuario();
                    $usuario->setTodo(
                        $_POST['correo'],
                        $_POST['cliente'],
                        $_POST['empresa'],
                        false,
                        $_POST['contrasena'],
                        ''
                    );
                    $usuario->registro($_POST['confirmacionContrasena']);

                    if($_POST['cliente'] == true){
                        $cliente = new Cliente();
                        $cliente->setTodo(
                        $_POST['nombre'],
                         $_POST['apellido'],
                         $_POST['fechaNacimiento'],
                         $_POST['fotoPerfil'],
                         $_POST['genero'],
                         $_POST['numeroTelefono'],
                         $_POST['numeroTarjeta'],
                         $_POST['fotoPortada'],
                         $_POST['refIdUsuario'] = $usuario->idUsuario
                        );
                        $cliente->guardarCliente();
                    }
                    if($usuario->empresa == true){
                        $empresa = new Empresa();
                        $empresa->setTodo(
                             $_POST['nombreEmpresa'],
                             $_POST['pais'],
                             $_POST['direccion'],
                             $_POST['logotipo'],
                             $_POST['telefono'],
                             $_POST['banner'],
                             $_POST['redesSociales'],
                             $_POST['refIdUsuario'] = $usuario->idUsuario
                            );
                            $empresa->guardarEmpresa();
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
