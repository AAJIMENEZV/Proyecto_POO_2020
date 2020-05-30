<?php 
     header("Content-Type: application/json");
     include_once("../class/class-cliente.php");
     include_once("../class/class-usuario.php");
     //$_POST = json_decode(file_get_contents('php://input'),true);
     switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
           
        break;
        case 'GET':
            //validar usuario
            //verificar si es cliente o empresa
            //si es valido obtener el cliente
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