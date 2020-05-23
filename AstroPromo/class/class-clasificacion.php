<?php
    class Clasificacion{
        private $idPromocion;
        private $idCliente;
        private $clasificacion;


        public function setTodo(
            $idPromocion,
            $idCliente,
            $clasificacion
        ){
            $this->idPromocion =$idPromocion;
            $this->idCliente =$idCliente;
            $this->clasificacion =$clasificacion;
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
         * Get the value of clasificacion
         */ 
        public function getClasificacion()
        {
                return $this->clasificacion;
        }

        /**
         * Set the value of clasificacion
         *
         * @return  self
         */ 
        public function setClasificacion($clasificacion)
        {
                $this->clasificacion = $clasificacion;

                return $this;
        }
    }



?>