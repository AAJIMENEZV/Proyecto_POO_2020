<?php 
     header("Content-Type: application/json");
     include_once("../class/class-clasificacion.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $clasificacion = new Clasificacion(
                $_POST['refIdPromocion'],
                $_POST['refIdCliente'],
                $_POST['clasificacion']
            );
            $clasificacion->guardarClasificacion();
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