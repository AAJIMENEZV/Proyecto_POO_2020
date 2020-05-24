<?php 
     header("Content-Type: application/json");
     include_once("../class/class-favorito.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $favorito = new Favorito(
                $_POST['refIdProducto'],
                $_POST['refIdPromocion'],
                $_POST['refIdCliente'],
                $_POST['fechaFavorito']
            );
            $favorito->guardarFavorito();
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
