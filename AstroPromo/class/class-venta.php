<?php
require_once 'Firestore.php';
class Venta
{
    private $idVenta;
    private $refIdPromocion;
    private $refIdProducto;
    private $refIdCliente;
    private $fechaVenta;

    public function __construct()
    {
        $this->fs = new Firestore('Venta');
    }

    public function setTodo(
        $idPromocion,
        $idProducto,
        $idCliente,
        $fechaVenta
    ) {
        $this->refIdPromocion = "/Promocion/" . $idPromocion;
        $this->refIdProducto = "/Producto/" . $idProducto;
        $this->refIdCliente = "/Cliente/" . $idCliente;
        $this->fechaVenta = $fechaVenta;
    }


    public function guardarVenta()
    {
        try {
            $this->idVenta = $this->fs->newDocument([
                'refIdPromocion' => $this->refIdPromocion,
                'refIdProducto' => $this->refIdProducto,
                'refIdCliente' => $this->refiIdCliente,
                'fechaVenta' => $this->fechaVenta,
            ]);
            return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerVenta($idVenta)
    {
        try {
            $query = $this->fs->getWhere("idVenta", $idVenta);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idVenta = $documento["id"];
                $this->refIdPromocion = $documento["refIdPromocion"];
                $this->refIdProducto = $documento["refIdProducto"];
                $this->refIdCliente = $documento["refIdCliente"];
                $this->fechaVenta = $documento["fechaVenta"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarVenta()
    {
        try {
            $this->fs->updateDocument($this->idVenta, [
                ['path' => 'refIdPromocion', 'value' => $this->refIdPromocion],
                ['path' => 'refIdProducto', 'value' => $this->refIdProducto],
                ['path' => 'refIdCliente', 'value' => $this->refIdCliente],
                ['path' => 'fechaVenta', 'value' => $this->fechaVenta]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function eliminarVenta()
    {
        try {
            $this->fs->dropDocument($this->idVenta);
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
        $this->refIdPromocion = "/Promocion/" . $idPromocion;
    }

    public function getIdCliente()
    {
        return explode("/", $this->refIdCliente)[2];
    }

    public function setIdCliente($idCliente)
    {
        $this->refIdCliente = "/Cliente/" . $idCliente;
    }

    public function getIdProducto()
    {
        return explode("/", $this->refIdProducto)[2];
    }

    public function setIdProducto($idProducto)
    {
        $this->refIdProducto = "/Producto/" . $idProducto;
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

    /**
     * Get the value of idVenta
     */
    public function getIdVenta()
    {
        return $this->idVenta;
    }

    /**
     * Set the value of idVenta
     *
     * @return  self
     */
    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;

        return $this;
    }
}
