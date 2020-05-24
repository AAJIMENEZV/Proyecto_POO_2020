<?php

require_once 'Firestore.php';
class Sucursal
{
    private $idSucursal;
    private $codigoSucursal;
    private $direccionSucursal;
    private $logintud;
    private $latitud;
    private $refIdEmpresa;

    public function __construct()
    {
        $this->fs = new Firestore('Sucursal');
    }

    public function setTodo(
        $codigoSucursal,
        $direccionSucursal,
        $logintud,
        $latitud,
        $idEmpresa
    ) {
        $this->codigoSucursal = $codigoSucursal;
        $this->direccionSucursal = $direccionSucursal;
        $this->logintud = $logintud;
        $this->latitud = $latitud;
        $this->refIdEmpresa = "/Empresa/" . $idEmpresa;
    }

    public function guardarSucursal()
    {
        try {
            $this->idSucursal = $this->fs->newDocument([
                'codigoSucursal' => $this->codigoSucursal,
                'direccionSucursal' => $this->direccionSucursal,
                'logintud' => $this->logintud,
                'latitud' => $this->latitud,
                'refIdEmpresa' => $this->refIdEmpresa
            ]);
            return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerSucursal($idSucursal)
    {
        try {
            $query = $this->fs->getWhere("idSucursal",$idSucursal);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idSucursal = $documento["id"];
                $this->codigoSucursal = $documento["codigoSucursal"];
                $this->direccionSucursal = $documento["direccionSucursal"];
                $this->logintud = $documento["logintud"];
                $this->latitud = $documento["latitud"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarSucursal()
    {
        try {
            $this->fs->updateDocument($this->idSucursal, [
                ['path' => 'codigoSucursal', 'value' => $this->codigoSucursal],
                ['path' => 'direccionSucursal', 'value' => $this->direccionSucursal],
                ['path' => 'logintud', 'value' => $this->logintud],
                ['path' => 'latitud', 'value' => $this->latitud]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }
    public function eliminarSucursal()
    {
        try {
            $this->fs->dropDocument($this->idSucursal);
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

    /**
     * Get the value of idSucursal
     */
    public function getIdSucursal()
    {
        return $this->idSucursal;
    }

    /**
     * Set the value of idSucursal
     *
     * @return  self
     */
    public function setIdSucursal($idSucursal)
    {
        $this->idSucursal = $idSucursal;

        return $this;
    }


    /**
     * Get the value of direccionSucursal
     */
    public function getDireccionSucursal()
    {
        return $this->direccionSucursal;
    }

    /**
     * Set the value of direccionSucursal
     *
     * @return  self
     */
    public function setDireccionSucursal($direccionSucursal)
    {
        $this->direccionSucursal = $direccionSucursal;

        return $this;
    }

    /**
     * Get the value of logintud
     */
    public function getLogintud()
    {
        return $this->logintud;
    }

    /**
     * Set the value of logintud
     *
     * @return  self
     */
    public function setLogintud($logintud)
    {
        $this->logintud = $logintud;

        return $this;
    }

    /**
     * Get the value of latitud
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set the value of latitud
     *
     * @return  self
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get the value of codigoSucursal
     */
    public function getCodigoSucursal()
    {
        return $this->codigoSucursal;
    }

    /**
     * Set the value of codigoSucursal
     *
     * @return  self
     */
    public function setCodigoSucursal($codigoSucursal)
    {
        $this->codigoSucursal = $codigoSucursal;

        return $this;
    }
}
