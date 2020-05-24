<?php 
     header("Content-Type: application/json");
     include_once("../class/class-cliente.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $cliente = new Cliente(
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['fechaNacimiento'],
                $_POST['fotoPerfil'],
                $_POST['genero'],
                $_POST['numeroTelefono'],
                $_POST['numeroTarjeta'],
                $_POST['fotoPortada'],
                $_POST['refIdUsuario']
            );
            $cliente->guardarCliente();
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