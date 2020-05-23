<?php
include_once ('classProducto.php');
include_once ('classProducto.php');
class Promociones{
    private $idPromocion;
    private $nombrePromocion;
    private $fechaInicio;
    private $fechaFinal;
    private $descuento;
    private $precioReal;
    private $precioOferta;
    private $producto;
    private $sucursal;
            function __construct($idPromocion, $nombrePromocion, $fechaInicio, $fechaFinal, $descuento, $precioReal, $precioOferta) {
        $this->idPromocion = $idPromocion;
        $this->nombrePromocion = $nombrePromocion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
        $this->descuento = $descuento;
        $this->precioReal = $precioReal;
        $this->precioOferta = $precioOferta;
        $this->$producto = new Producto();
        $this->$sucursal = new Sucursal();       
    }

    function getIdPromocion() {
        return $this->idPromocion;
    }

    function getNombrePromocion() {
        return $this->nombrePromocion;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFinal() {
        return $this->fechaFinal;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getPrecioReal() {
        return $this->precioReal;
    }

    function getPrecioOferta() {
        return $this->precioOferta;
    }

    function setIdPromocion($idPromocion) {
        $this->idPromocion = $idPromocion;
    }

    function setNombrePromocion($nombrePromocion) {
        $this->nombrePromocion = $nombrePromocion;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFinal($fechaFinal) {
        $this->fechaFinal = $fechaFinal;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setPrecioReal($precioReal) {
        $this->precioReal = $precioReal;
    }

    function setPrecioOferta($precioOferta) {
        $this->precioOferta = $precioOferta;
    }
    
    function getProducto() {
        return $this->producto;
    }

    function getSucursal() {
        return $this->sucursal;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setSucursal($sucursal) {
        $this->sucursal = $sucursal;
    }

    
     public function crearPromocion($db){
            $promocion = $this->getData();
            $result= $db->getReference('promociones')
                    ->push($promocion);
            $result->getKey();
        }
        
               public function actualizarPromocion($db, $id){
            $db->getReference('promociones')
               ->getChild($id)
               ->set($this->getData());
           
        }
                public static function eliminarPromocion($db, $id){
            $db->getReference('promociones')
                    ->getChild($id)
                    ->remove();
            echo 'Mensaje: Se elimino correctamente';
        }
        
                public function getData(){
            $result['nombrePromocion'] = $this->nombrePromocion;
            $result['fechaInicio'] = $this->fechaInicio;
            $result['fechaFinal'] = $this->fechaFinal;
            $result['descuento'] = $this->descuento;
            $result['precioReal'] = $this->precioReal;
            $result['precioOferta'] = $this->precioOferta;
            $result['producto'] = $this->producto;
            $result['sucursal'] = $this->sucursal;
            return $result;
        }
        
        public static function obtenerPromociones($db){
            $result = $db->getReference('promociones')
                    ->getSnapshot()
                    ->getValue();
            echo json_encode($result) ;
            }
        public static function obtenerPromocion($db, $id){
            $result = $db->getReference('promociones')
                    ->getChild($id)
                    ->getValue();
                echo json_encode($result);
        }


}
