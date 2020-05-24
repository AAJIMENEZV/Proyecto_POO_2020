<?php 
     header("Content-Type: application/json");
     include_once("../class/class-venta.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $venta = new Venta(
                $_POST['refIdPromocion'],
                $_POST['refIdProducto'],
                $_POST['refIdCliente'],
                $_POST['fechaVenta']
            );
            $venta->guardarVenta();
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