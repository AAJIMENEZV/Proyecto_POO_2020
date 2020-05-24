<?php 
     header("Content-Type: application/json");
     include_once("../class/class-comentario.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $comentario = new Comentario(
                $_POST['refIdPromocion'],
                $_POST['refIdcomentario'],
                $_POST['comentario']
            );
            $comentario->guardarComentario();
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