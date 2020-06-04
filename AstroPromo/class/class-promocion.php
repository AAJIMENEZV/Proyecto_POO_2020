<?php
require_once 'Firestore.php';
class Promocion
{
    private $idPromocion;
    private $nombrePromocion;
    private $descripcionPromocion;
    private $imagenPromocion;
    private $refIdProducto;
    private $descuento;
    private $precioNormal;
    private $precioOferta;
    private $fechaVencimiento;
    private $fechaInicio;
    private $refIdEmpresa;
    private $refIdSucursal;

    public function __construct()
    {
        $this->fs = new Firestore('Promocion');
    }


    public function setTodo(
        $nombrePromocion,
        $descripcionPromocion,
        $imagenPromocion,
        $idProducto,
        $descuento,
        $precioNormal,
        $precioOferta,
        $fechaVencimiento,
        $fechaInicio,
        $idEmpresa,
        $idSucursal
    ) {
        $this->nombrePromocion = $nombrePromocion;
        $this->descripcionPromocion = $descripcionPromocion;
        $this->imagenPromocion = $imagenPromocion;
        $this->refIdProducto = "Producto/" . $idProducto;
        $this->descuento = $descuento;
        $this->precioNormal = $precioNormal;
        $this->precioOferta = $precioOferta;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->fechaInicio = $fechaInicio;
        $this->refIdEmpresa = "Empresa/" . $idEmpresa;
        $this->refIdSucursal = "Sucursal/" . $idSucursal;
    }


    public function guardarPromocion()
    {
        try {
            $this->idPromocion = $this->fs->newDocument([
                'nombrePromocion' => $this->nombrePromocion,
                'descripcionPromocion' => $this->descripcionPromocion,
                'imagenPromocion' => $this->imagenPromocion,
                'refIdProducto' => $this->refIdProducto,
                'descuento' => $this->descuento,
                'precioNormal' => $this->precioNormal,
                'precioOferta' => $this->precioOferta,
                'fechaVencimiento' => $this->fechaVencimiento,
                'fechaInicio' => $this->fechaInicio,
                'refIdEmpresa' => $this->refIdEmpresa,
                'refIdSucursal' => $this->refIdSucursal
            ]);
            return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerPromocion($idPromocion)
    {
        try {
            $query = $this->fs->getWhere("idPromocion", $idPromocion);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idPromocion = $documento["id"];
                $this->nombrePromocion = $documento["nombrePromocion"];
                $this->descripcionPromocion = $documento["descripcionPromocion"];
                $this->imagenPromocion = $documento["imagenPromocion"];
                $this->refIdProducto = $documento["idProducto"];
                $this->descuento = $documento["descuento"];
                $this->precioNormal = $documento["precioNormal"];
                $this->precioOferta = $documento["precioOferta"];
                $this->fechaVencimiento = $documento["fechaVencimiento"];
                $this->fechaInicio = $documento["fechaInicio"];
                $this->refIdSucursal = $documento["refIdSucursal"];
                $respuesta["valido"] = true;
                $respuesta["mensaje"] = "Obtenido con exito";
                return $respuesta;
            } else {
                $respuesta["valido"] = false;
                $respuesta["mensaje"] = "No encontrado";
                return $respuesta;
            }
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }

    public function obtenerPromocionPorId()
    {
        try {

            $documento = $this->fs->getDocument($this->idPromocion);
            $this->idPromocion = $documento["id"];
            $this->nombrePromocion = $documento["nombrePromocion"];
            $this->descripcionPromocion = $documento["descripcionPromocion"];
            $this->imagenPromocion = $documento["imagenPromocion"];
            $this->refIdProducto = $documento["refIdProducto"];
            $this->descuento = $documento["descuento"];
            $this->precioNormal = $documento["precioNormal"];
            $this->precioOferta = $documento["precioOferta"];
            $this->fechaVencimiento = $documento["fechaVencimiento"];
            $this->fechaInicio = $documento["fechaInicio"];
            $this->refIdSucursal = $documento["refIdSucursal"];
            $respuesta["valido"] = true;
            $respuesta["mensaje"] = "Obtenido con exito";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }


    public function obtenerPromocionEmpresa($idEmpresa)
    {
        try {
            $query = $this->fs->getWhere("refIdEmpresa", "Empresa/" . $idEmpresa);
            return $query;
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerPromociones()
    {
        try {
            $query = $this->fs->obtenerTodosDocumentos();
            return $query;
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarPromocion()
    {
        try {
            $this->fs->updateDocument($this->idPromocion, [
                ['path' => 'nombrePromocion', 'value' => $this->nombrePromocion],
                ['path' => 'descripcionPromocion', 'value' => $this->descripcionPromocion],
                ['path' => 'imagenPromocion', 'value' => $this->imagenPromocion],
                ['path' => 'idProducto', 'value' => $this->refIdProducto],
                ['path' => 'descuento', 'value' => $this->descuento],
                ['path' => 'precioNormal', 'value' => $this->precioNormal],
                ['path' => 'precioOferta', 'value' => $this->precioOferta],
                ['path' => 'fechaVencimiento', 'value' => $this->fechaVencimiento],
                ['path' => 'fechaInicio', 'value' => $this->fechaInicio],
                ['path' => 'refIdSucursal', 'value' => $this->refIdSucursal]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }
    public function eliminarPromocion()
    {
        try {
            $this->fs->dropDocument($this->idPromocion);
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function getIdEmpresa()
    {
        return explode("/", $this->refIdEmpresa)[1];
    }

    public function setIdEmpresa($idEmpresa)
    {
        $this->refIdEmpresa = "Empresa/" . $idEmpresa;
    }

    public function getIdProducto()
    {
        return explode("/", $this->refIdProducto)[1];
    }

    public function setIdProducto($idProducto)
    {
        $this->refIdProducto = "Producto/" . $idProducto;
    }
    public function getIdSucursal()
    {
        return explode("/", $this->refIdSucursal)[1];
    }

    public function setIdSucursal($idSucursal)
    {
        $this->refIdSucursal = "Sucursal/" . $idSucursal;
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
     * Get the value of nombrePromocion
     */
    public function getNombrePromocion()
    {
        return $this->nombrePromocion;
    }

    /**
     * Set the value of nombrePromocion
     *
     * @return  self
     */
    public function setNombrePromocion($nombrePromocion)
    {
        $this->nombrePromocion = $nombrePromocion;

        return $this;
    }

    /**
     * Get the value of descripcionPromocion
     */
    public function getDescripcionPromocion()
    {
        return $this->descripcionPromocion;
    }

    /**
     * Set the value of descripcionPromocion
     *
     * @return  self
     */
    public function setDescripcionPromocion($descripcionPromocion)
    {
        $this->descripcionPromocion = $descripcionPromocion;

        return $this;
    }

    /**
     * Get the value of imagenPromocion
     */
    public function getImagenPromocion()
    {
        return $this->imagenPromocion;
    }

    /**
     * Set the value of imagenPromocion
     *
     * @return  self
     */
    public function setImagenPromocion($imagenPromocion)
    {
        $this->imagenPromocion = $imagenPromocion;

        return $this;
    }



    /**
     * Get the value of descuento
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set the value of descuento
     *
     * @return  self
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get the value of precioNormal
     */
    public function getPrecioNormal()
    {
        return $this->precioNormal;
    }

    /**
     * Set the value of precioNormal
     *
     * @return  self
     */
    public function setPrecioNormal($precioNormal)
    {
        $this->precioNormal = $precioNormal;

        return $this;
    }

    /**
     * Get the value of precioOferta
     */
    public function getPrecioOferta()
    {
        return $this->precioOferta;
    }

    /**
     * Set the value of precioOferta
     *
     * @return  self
     */
    public function setPrecioOferta($precioOferta)
    {
        $this->precioOferta = $precioOferta;

        return $this;
    }

    /**
     * Get the value of fechaVencimiento
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set the value of fechaVencimiento
     *
     * @return  self
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get the value of fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }
}
