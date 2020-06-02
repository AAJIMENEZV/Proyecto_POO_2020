<?php
require_once 'Firestore.php';
    class Comentario{
        private $idComentario;
        private $refIdPromocion;
        private $refIdCliente;
        private $comentario;

        public function __construct()
    {
        $this->fs = new Firestore('Comentario');
    }

        public function setTodo(
            $idPromocion,
            $idCliente,
            $comentario
        ){
            $this->refIdPromocion="Promocion/".$idPromocion;
            $this->refIdCliente="Cliente/".$idCliente;
            $this->comentario=$comentario;
        }

        public function guardarComentario()
    {
        try {
            $this->idComentario = $this->fs->newDocument([
                'refIdPromocion' => $this->refIdPromocion,
                'refIdCliente' => $this->refIdCliente,
                'comentario' => $this->comentario
            ]);
            return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerComentario($idComentario)
    {
        try {
            $query = $this->fs->getWhere("idComentario", $idComentario);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idComentario = $documento["id"];
                $this->refIdPromocion = $documento["refIdPromocion"];
                $this->refIdCliente = $documento["refIdCliente"];
                $this->comentario = $documento["comentario"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarComentario()
    {
        try {
            $this->fs->updateDocument($this->idComentario, [
                ['path' => 'refIdPromocion', 'value' => $this->refIdPromocion],
                ['path' => 'refIdCliente', 'value' => $this->refIdCliente],
                ['path' => 'comentario', 'value' => $this->comentario],
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function eliminarComentario()
    {
        try {
            $this->fs->dropDocument($this->idComentario);
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

        /**
         * Get the value of idComentario
         */ 
        public function getIdComentario()
        {
                return $this->idComentario;
        }

        /**
         * Set the value of idComentario
         *
         * @return  self
         */ 
        public function setIdComentario($idComentario)
        {
                $this->idComentario = $idComentario;

                return $this;
        }
    }
