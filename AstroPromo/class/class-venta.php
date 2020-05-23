<?php
require_once 'Firestore.php';
    class Venta{
        private $idVenta;
        private $idPromocion;
        private $idCliente;
        private $fechaVenta;

        public function __construct()
    {
        $this->fs = new Firestore('Venta');
    }

        public function setTodo(
            $id,
            $idCliente,
            $fechaVenta   
        ){
            $this->idCliente = $idCliente;
            $this->fechaVenta = $fechaVenta;
        }


        public function guardarVenta(){
            try{
                 $this->idPromocion = $this->fs->newDocument([
                     'idCliente' => $this->idCliente ,
                     'fechaVenta' => $this->fechaVenta,
                     ]);
                 return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
             }catch(Exception $e){
                 
                 return'{"codigoResultado":"0","mensaje":"'.$e->getMessage().'"}';
             }
       }
  
       

        /**
         * Get the value of idPromocion
         */ 
        public function getIdPromocion()
        {
                return $this->idPromocion;
        }

        /**
         * Set the value of idPromocion
         *
         * @return  self
         */ 
        public function setIdPromocion($idPromocion)
        {
                $this->idPromocion = $idPromocion;

                return $this;
        }

        /**
         * Get the value of idCliente
         */ 
        public function getIdCliente()
        {
                return $this->idCliente;
        }

        /**
         * Set the value of idCliente
         *
         * @return  self
         */ 
        public function setIdCliente($idCliente)
        {
                $this->idCliente = $idCliente;

                return $this;
        }

        /**
         * Get the value of fechaVenta
         */ 
        public function getFechaVenta()
        {
                return $this->fechaVenta;
        }

        /**
         * Set the value of fechaVenta
         *
         * @return  self
         */ 
        public function setFechaVenta($fechaVenta)
        {
                $this->fechaVenta = $fechaVenta;

                return $this;
        }
    }

?>