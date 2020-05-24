<?php 
     header("Content-Type: application/json");
     include_once("../class/class-producto.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $producto = new Producto(
                $_POST['nombreProducto'],
                $_POST['descripcion'],
                $_POST['precio'],
                $_POST['fotoProducto'],
                $_POST['refIdEmpresa']
            );
            $producto->guardarProducto();
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