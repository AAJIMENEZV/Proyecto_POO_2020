<?php
    class Comentario{
        private $idPromocion;
        private $idCliente;
        private $comentario;


        public function setTodo(
            $idPromocion,
            $idCliente,
            $comentario
        ){
            $this->idPromocion=$idPromocion;
            $this->idCliente=$idCliente;
            $this->comentario=$comentario;
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
         * Get the value of comentario
         */ 
        public function getComentario()
        {
                return $this->comentario;
        }

        /**
         * Set the value of comentario
         *
         * @return  self
         */ 
        public function setComentario($comentario)
        {
                $this->comentario = $comentario;

                return $this;
        }
    }
