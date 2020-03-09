<?php
 class Producto{
     private $idProducto;
     private $nombreProducto;
     private $descripcion;
     private $precio;
     private $fotoProducto;
     
     function __construct($nombreProducto, $Descripcion, $precio, $fotoProducto) {
         $this->nombreProducto = $nombreProducto;
         $this->descripcion = $Descripcion;
         $this->precio = $precio;
         $this->fotoProducto = $fotoProducto;
     }

     
     function getIdProducto() {
         return $this->idProducto;
     }

     function getNombreProducto() {
         return $this->nombreProducto;
     }

     function getDescripcion() {
         return $this->descripcion;
     }

     function getPrecio() {
         return $this->precio;
     }

     function getFotoProducto() {
         return $this->fotoProducto;
     }

     function setIdProducto($idProducto) {
         $this->idProducto = $idProducto;
     }

     function setNombreProducto($nombreProducto) {
         $this->nombreProducto = $nombreProducto;
     }

     function setDescripcion($descripcion) {
         $this->descripcion = $descripcion;
     }

     function setPrecio($precio) {
         $this->precio = $precio;
     }

     function setFotoProducto($fotoProducto) {
         $this->fotoProducto = $fotoProducto;
     }
     
     public function crearCliente($db){
            $productos = $this->getData();
            $result= $db->getReference('producto')
                    ->push($productos);
            $result->getKey();
        }
        
               public function actualizarProducto($db, $id){
            $db->getReference('producto')
               ->getChild($id)
               ->set($this->getData());
           
        }
                public static function eliminarProducto($db, $id){
            $db->getReference('producto')
                    ->getChild($id)
                    ->remove();
            echo 'Mensaje: Se elimino correctamente';
        }
        
                public function getData(){
            $result['nombreProducto'] = $this->nombreProducto;
            $result['descripcion'] = $this->descripcion;
            $result['precio'] = $this->precio;
            $result['fotoProducto'] = $this->fotoProducto;
            return $result;
        }
        
        public static function obtenerProductos($db){
            $result = $db->getReference('producto')
                    ->getSnapshot()
                    ->getValue();
            echo json_encode($result) ;
            }
        public static function obtenerProducto($db, $id){
            $result = $db->getReference('producto')
                    ->getChild($id)
                    ->getValue();
                echo json_encode($result);
        }

     
     
 }