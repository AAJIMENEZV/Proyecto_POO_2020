<?php
class Sucursal{
    private $idSucursal;
    private $nombreSucursal;
    private $direccionSucursal;
    private $logintud;
    private $latitud;
    
    function __construct($nombreSucursal, $direccionSucursal, $logintud, $latitud) {
        $this->nombreSucursal = $nombreSucursal;
        $this->direccionSucursal = $direccionSucursal;
        $this->logintud = $logintud;
        $this->latitud = $latitud;
    }
    function getIdSucursal() {
        return $this->idSucursal;
    }

    function getNombreSucursal() {
        return $this->nombreSucursal;
    }

    function getDireccionSucursal() {
        return $this->direccionSucursal;
    }

    function getLogintud() {
        return $this->logintud;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function setIdSucursal($idSucursal) {
        $this->idSucursal = $idSucursal;
    }

    function setNombreSucursal($nombreSucursal) {
        $this->nombreSucursal = $nombreSucursal;
    }

    function setDireccionSucursal($direccionSucursal) {
        $this->direccionSucursal = $direccionSucursal;
    }

    function setLogintud($logintud) {
        $this->logintud = $logintud;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }


        public function crearSucursal($db){
            $sucursal = $this->getData();
            $result= $db->getReference('sucursales')
                    ->push($sucursal);
            $result->getKey();
        }
        
               public function actualizarSucursal($db, $id){
            $db->getReference('sucursales')
               ->getChild($id)
               ->set($this->getData());
           
        }
                public static function eliminarSucursal($db, $id){
            $db->getReference('sucursales')
                    ->getChild($id)
                    ->remove();
            echo 'Mensaje: Se elimino correctamente';
        }
        
                public function getData(){
            $result['nombreSucursal'] = $this->nombreSucursal;
            $result['direccionSucursal'] = $this->direccionSucursal;
            $result['logintud'] = $this->logintud;
            $result['latitud'] = $this->latitud;
            return $result;
        }
        
        public static function obtenerSucursales($db){
            $result = $db->getReference('sucursales')
                    ->getSnapshot()
                    ->getValue();
            echo json_encode($result) ;
            }
        public static function obtenerSucursal($db, $id){
            $result = $db->getReference('sucursales')
                    ->getChild($id)
                    ->getValue();
                echo json_encode($result);
        }
    
}