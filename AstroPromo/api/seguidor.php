<?php 
     header("Content-Type: application/json");
     include_once("../class/class-seguidor.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $seguidor = new Seguidor(
                $_POST['refIdEmpresa'],
                $_POST['refIdCliente'],
                $_POST['fechaSeguidor']
            );
            $seguidor->guardarSeguidor();
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