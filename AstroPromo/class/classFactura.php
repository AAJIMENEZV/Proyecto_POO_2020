<?php
require_once 'classCliente.php';
require_once'classPromociones.php';
class Factura{
    private $idFactura;
    private $cliente;
    private $promocion;
    private $pagar;
    
    function __construct($cliente, $promocion, $pagar) {
        $this->cliente = new Cliente();
        $this->promocion = new Promociones();
        $this->pagar = $pagar;
    }

    function getIdFactura() {
        return $this->idFactura;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getPromocion() {
        return $this->promocion;
    }

    function getPagar() {
        return $this->pagar;
    }

    function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setPromocion($promocion) {
        $this->promocion = $promocion;
    }

    function setPagar($pagar) {
        $this->pagar = $pagar;
    }

 public function crearFactura($db){
            $factura = $this->getData();
            $result= $db->getReference('factura')
                    ->push($factura);
            $result->getKey();
        }
        
               public function actualizarFactura($db, $id){
            $db->getReference('factura')
               ->getChild($id)
               ->set($this->getData());
           
        }
                public static function eliminarFactura($db, $id){
            $db->getReference('factura')
                    ->getChild($id)
                    ->remove();
            echo 'Mensaje: Se elimino correctamente';
        }
        
                public function getData(){
            $result['cliente'] = $this->cliente;
            $result['promocion'] = $this->promocion;
            $result['pagar'] = $this->pagar;
            return $result;
        }
        
        public static function obtenerFacturas($db){
            $result = $db->getReference('factura')
                    ->getSnapshot()
                    ->getValue();
            echo json_encode($result) ;
            }
        public static function obtenerFactura($db, $id){
            $result = $db->getReference('factura')
                    ->getChild($id)
                    ->getValue();
                echo json_encode($result);
        }


}

