<?php 
     header("Content-Type: application/json");
     include_once("../class/class-promocion.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $promocion = new Promocion(
                $_POST['nombrePromocion'],
                $_POST['descripcionPromocion'],
                $_POST['imagenPromocion'],
                $_POST['refIdProducto'],
                $_POST['descuento'],
                $_POST['precioNormal'],
                $_POST['precioPromocion'],
                $_POST['fechaVencimiento'],
                $_POST['fechaInicio'],
                $_POST['refIdEmpresa']
            );
            $promocion->guardarPromocion();
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