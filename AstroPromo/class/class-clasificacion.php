<?php
require_once 'Firestore.php';
    class Clasificacion{
        private $idClasificacion;
        private $refIdPromocion;
        private $refIdCliente;
        private $clasificacion;

        public function __construct()
    {
        $this->fs = new Firestore('Clasificacion');
    }

        public function setTodo(
            $idPromocion,
            $idCliente,
            $clasificacion
        ){
            $this->refIdPromocion ="Promocion/".$idPromocion;
            $this->refIdCliente ="Cliente/".$idCliente;
            $this->clasificacion =$clasificacion;
        }


        public function guardarClasificacion()
        {
            try {
                $this->idClasificacion = $this->fs->newDocument([
                    'refIdPromocion' => $this->refIdPromocion,
                    'refIdCliente' => $this->refIdCliente,
                    'clasificacion' => $this->clasificacion
                ]);
                return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
            } catch (Exception $e) {
    
                return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
            }
        }
    
        public function obtenerClasificacion($idClasificacion)
        {
            try {
                $query = $this->fs->getWhere("idClasificacion", $idClasificacion);
                if (!empty($query)) {
                    $documento = $query[0];
                    $this->idClasificacion = $documento["id"];
                    $this->refIdPromocion = $documento["refIdPromocion"];
                    $this->refIdCliente = $documento["refIdCliente"];
                    $this->clasificacion = $documento["clasificacion"];
                    return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
                } else {
                    return '{"codigoResultado":"0","mensaje":"No encontrado"}';
                }
            } catch (Exception $e) {
                return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
            }
        }
    
        public function actualizarClasificacion()
        {
            try {
                $this->fs->updateDocument($this->idClasificacion, [
                    ['path' => 'refIdPromocion', 'value' => $this->refIdPromocion],
                    ['path' => 'refIdCliente', 'value' => $this->refIdCliente],
                    ['path' => 'clasificacion', 'value' => $this->clasificacion]
                ]);
                return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
            } catch (Exception $e) {
    
                return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
            }
        }
    
        public function eliminarClasificacion()
        {
            try {
                $this->fs->dropDocument($this->idClasificacion);
                return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
            } catch (Exception $e) {
                return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
            }
        }
    
        public function getIdPromocion()
        {
            return explode("/", $this->refIdPromocion)[2];
        }
    
        public function setIdPromocion($idPromocion)
        {
            $this->refIdPromocion = "Promocion/" . $idPromocion;
        }
    
        public function getIdCliente()
        {
            return explode("/", $this->refIdCliente)[2];
        }
    
        public function setIdCliente($idCliente)
        {
            $this->refIdCliente = "Cliente/" . $idCliente;
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

        /**
         * Get the value of idClasificacion
         */ 
        public function getIdClasificacion()
        {
                return $this->idClasificacion;
        }

        /**
         * Set the value of idClasificacion
         *
         * @return  self
         */ 
        public function setIdClasificacion($idClasificacion)
        {
                $this->idClasificacion = $idClasificacion;

                return $this;
        }
    }
