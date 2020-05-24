<?php 
     header("Content-Type: application/json");
     include_once("../class/class-usuario.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $usuario = new Usuario(
                $_POST['correo'],
                $_POST['cliente'],
                $_POST['empresa'],
                $_POST['superUsuario'],
                $_POST['contrasena']
            );
            $usuario->guardarUsuario();
        break;
        case 'GET':
            if(isset($_GET[''])){
               
            }if(isset($_GET[''])){
                
            }else{

            }
        break;
        case 'PUT':
        break;
        case 'DELETE':
        break;
     }

?>