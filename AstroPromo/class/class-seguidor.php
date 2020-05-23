<?php
    class Seguidor{
        private $idEmpresa;
        private $idCliente;
        private $fechaSeguidor;


        public function setTodo(
            $idEmpresa,
            $idCliente,
            $fechaSeguidor
        ){
            $this->idEmpresa = $idEmpresa;
            $this->idCliente = $idCliente;
            $this->fechaSeguidor = $fechaSeguidor;
        }

        /**
         * Get the value of idEmpresa
         */ 
        public function getIdEmpresa()
        {
                return $this->idEmpresa;
        }

        /**
         * Set the value of idEmpresa
         *
         * @return  self
         */ 
        public function setIdEmpresa($idEmpresa)
        {
                $this->idEmpresa = $idEmpresa;

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
         * Get the value of fechaSeguidor
         */ 
        public function getFechaSeguidor()
        {
                return $this->fechaSeguidor;
        }

        /**
         * Set the value of fechaSeguidor
         *
         * @return  self
         */ 
        public function setFechaSeguidor($fechaSeguidor)
        {
                $this->fechaSeguidor = $fechaSeguidor;

                return $this;
        }
    }



?>