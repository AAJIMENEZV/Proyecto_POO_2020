<?php 
     header("Content-Type: application/json");
     include_once("../class/class-empresa.php");
     //$_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $empresa = new Empresa(
                $_POST['nombreEmpresa'],
                $_POST['pais'],
                $_POST['direccion'],
                $_POST['logotipo'],
                $_POST['telefono'],
                $_POST['banner'],
                $_POST['redesSociales'],
                $_POST['refIdUsuario']
            );
            $empresa->guardarEmpresa();
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