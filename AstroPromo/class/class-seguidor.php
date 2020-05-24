<?php
require_once 'Firestore.php';
class Seguidor
{
        private $idSeguidor;
        private $refIdEmpresa;
        private $refIdCliente;
        private $fechaSeguidor;

        public function __construct()
        {
                $this->fs = new Firestore('Seguidor');
        }



        public function setTodo(
                $idEmpresa,
                $idCliente,
                $fechaSeguidor
        ) {
                $this->refIdEmpresa = "/Empresa/" . $idEmpresa;
                $this->refIdCliente = "/Cliente/" . $idCliente;
                $this->fechaSeguidor = $fechaSeguidor;
        }

        public function guardarSeguidor()
        {
                try {
                        $this->idSeguidor = $this->fs->newDocument([
                                'refIdEmpresa' => $this->refIdEmpresa,
                                'refIdCliente' => $this->refIdCliente,
                                'fechaSeguidor' => $this->fechaSeguidor
                        ]);
                        return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
                } catch (Exception $e) {

                        return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
                }
        }

        public function obtenerSeguidor($idSeguidor)
        {
                try {
                        $query = $this->fs->getWhere("idSeguidor", $idSeguidor);
                        if (!empty($query)) {
                                $documento = $query[0];
                                $this->idSeguidor = $documento["id"];
                                $this->refIdEmpresa = $documento["refIdEmpresa"];
                                $this->refIdCliente = $documento["refIdCliente"];
                                $this->fechaSeguidor = $documento["fechaSeguidor"];
                                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
                        } else {
                                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
                        }
                } catch (Exception $e) {
                        return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
                }
        }

        public function actualizarSeguidor()
        {
                try {
                        $this->fs->updateDocument($this->idSeguidor, [
                                ['path' => 'refIdEmpresa', 'value' => $this->refIdEmpresa],
                                ['path' => 'refIdCliente', 'value' => $this->refIdCliente],
                                ['path' => 'fechaSeguidor', 'value' => $this->fechaSeguidor]
                        ]);
                        return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
                } catch (Exception $e) {

                        return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
                }
        }

        public function eliminarSeguidor()
        {
                try {
                        $this->fs->dropDocument($this->idSeguidor);
                        return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
                } catch (Exception $e) {
                        return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
                }
        }
        
        public function getIdEmpresa()
        {
                return explode("/", $this->refIdEmpresa)[2];
        }

        public function setIdEmpresa($idEmpresa)
        {
                $this->refIdEmpresa = "/Empresa/" . $idEmpresa;
        }

        public function getIdCliente()
        {
                return explode("/", $this->refIdCliente)[2];
        }

        public function setIdCliente($idCliente)
        {
                $this->refIdCliente = "/Cliente/" . $idCliente;
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

        /**
         * Get the value of idSeguidor
         */
        public function getIdSeguidor()
        {
                return $this->idSeguidor;
        }

        /**
         * Set the value of idSeguidor
         *
         * @return  self
         */
        public function setIdSeguidor($idSeguidor)
        {
                $this->idSeguidor = $idSeguidor;

                return $this;
        }
}
