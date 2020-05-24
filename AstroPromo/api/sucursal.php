<?php 
     header("Content-Type: application/json");
     include_once("../class/class-sucursal.php");
     $_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $sucursal = new Sucursal(
                $_POST['codigoSucursal'],
                $_POST['direccionSucursal'],
                $_POST['logintud'],
                $_POST['latitud'],
                $_POST['refIdEmpresa']
            );
            $sucursal->guardarSucursal();
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