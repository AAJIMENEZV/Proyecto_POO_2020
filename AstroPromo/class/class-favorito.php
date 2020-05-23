<?php
    class Favorito{
        private $idProducto;
        private $idPromocion;
        private $idCliente;
        private $fechaFavorito;

        public function setTodo(
            $idProducto,
            $idPromocion,
            $idCliente,
            $fechaFavorito
        ){
            $this->idProducto = $idProducto;
            $this->idPromocion = $idPromocion;
            $this->idCliente = $idCliente;
            $this->fechaFavorito = $fechaFavorito;
        }




        /**
         * Get the value of idProducto
         */ 
        public function getIdProducto()
        {
                return $this->idProducto;
        }

        /**
         * Set the value of idProducto
         *
         * @return  self
         */ 
        public function setIdProducto($idProducto)
        {
                $this->idProducto = $idProducto;

                return $this;
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
         * Get the value of fechaFavorito
         */ 
        public function getFechaFavorito()
        {
                return $this->fechaFavorito;
        }

        /**
         * Set the value of fechaFavorito
         *
         * @return  self
         */ 
        public function setFechaFavorito($fechaFavorito)
        {
                $this->fechaFavorito = $fechaFavorito;

                return $this;
        }
    }


?>