<?php
require_once 'Firestore.php';
class Favorito
{
    private $idFavorito;
    private $refIdProducto;
    private $refIdPromocion;
    private $refIdCliente;
    private $fechaFavorito;

    public function __construct()
    {
        $this->fs = new Firestore('Favorito');
    }

    public function setTodo(
        $idProducto,
        $idPromocion,
        $idCliente,
        $fechaFavorito
    ) {
        $this->refIdProducto = "Producto/".$idProducto;
        $this->refIdPromocion = "Promocion/".$idPromocion;
        $this->refIdCliente = "Cliente/".$idCliente;
        $this->fechaFavorito = $fechaFavorito;
    }

    public function guardarFavorito()
    {
        try {
            $this->idFavorito = $this->fs->newDocument([
                'refIdProducto' => $this->refIdProducto,
                'refIdPromocion' => $this->refIdPromocion,
                'refIdCliente' => $this->refIdCliente,
                'fechaFavorito' => $this->fechaFavorito,
            ]);
            return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerFavorito($idFavorito)
    {
        try {
            $query = $this->fs->getWhere("idFavorito", $idFavorito);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idFavorito = $documento["id"];
                $this->refIdProducto = $documento["refIdProducto"];
                $this->refIdPromocion = $documento["refIdPromocion"];
                $this->refIdCliente = $documento["refIdCliente"];
                $this->fechaFavorito = $documento["fechaFavorito"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarFavorito()
    {
        try {
            $this->fs->updateDocument($this->idFavorito, [
                ['path' => 'refIdProducto', 'value' => $this->refIdProducto],
                ['path' => 'refIdPromocion', 'value' => $this->refIdPromocion],
                ['path' => 'refIdCliente', 'value' => $this->refIdCliente],
                ['path' => 'fechaFavorito', 'value' => $this->fechaFavorito]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function eliminarFavorito()
    {
        try {
            $this->fs->dropDocument($this->idFavorito);
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function getIdProducto()
    {
        return explode("/", $this->refIdProducto)[2];
    }

    public function setIdProducto($idProducto)
    {
        $this->refIdProducto = "Producto/" . $idProducto;
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

    /**
     * Get the value of idFavorito
     */
    public function getIdFavorito()
    {
        return $this->idFavorito;
    }

    /**
     * Set the value of idFavorito
     *
     * @return  self
     */
    public function setIdFavorito($idFavorito)
    {
        $this->idFavorito = $idFavorito;

        return $this;
    }
}
