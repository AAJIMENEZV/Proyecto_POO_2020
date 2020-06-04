<?php
require_once 'Firestore.php';
require_once 'class-producto.php';
require_once 'class-sucursal.php';
require_once 'class-promocion.php';
class Empresa
{
    private $idEmpresa;
    private $nombreEmpresa;
    private $pais;
    private $direccion;
    private $logotipo;
    private $telefono;
    private $banner;
    private $redesSociales;
    private $fs;
    private $refIdUsuario;

    public function __construct()
    {
        $this->fs = new Firestore('Empresa');
    }
    public function comoArreglo()
    {
        $arreglo = array();
        $arreglo["idEmpresa"] = $this->idEmpresa;
        $arreglo["nombreEmpresa"] = $this->nombreEmpresa;
        $arreglo["pais"] = $this->pais;
        $arreglo["direccion"] = $this->direccion;
        $arreglo["logotipo"] = $this->logotipo;
        $arreglo["telefono"] = $this->telefono;
        $arreglo["banner"] = $this->banner;
        $arreglo["redesSociales"] = $this->redesSociales;
        $arreglo["refIdUsuario"] = $this->refIdUsuario;
        return $arreglo;
    }

    public function setTodo(
        $nombreEmpresa,
        $pais,
        $direccion,
        $logotipo,
        $telefono,
        $banner,
        $redesSociales,
        $idUsuario
    ) {
        $this->nombreEmpresa = $nombreEmpresa;
        $this->pais = $pais;
        $this->direccion = $direccion;
        $this->logotipo = $logotipo;
        $this->telefono = $telefono;
        $this->banner = $banner;
        $this->redesSociales = $redesSociales;
        $this->refIdUsuario = "Usuario/" . $idUsuario;
    }

    public function guardarEmpresa()
    {
        try {
            if (empty($this->fs->getWhere("refIdUsuario", $this->refIdUsuario))) {
                $this->idEmpresa = $this->fs->newDocument([
                    'nombreEmpresa' => $this->nombreEmpresa,
                    'pais' => $this->pais,
                    'direccion' => $this->direccion,
                    'logotipo' => $this->logotipo,
                    'telefono' => $this->telefono,
                    'banner' => $this->banner,
                    'redesSociales' => $this->redesSociales,
                    'refIdUsuario' => $this->refIdUsuario
                ]);
                return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"Ya existe"}';
            }
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }


    public function obtenerEmpresa($idUsuario)
    {
        try {
            $query = $this->fs->getWhere("refIdUsuario", "Usuario/" . $idUsuario);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idEmpresa = $documento["id"];
                $this->nombreEmpresa = $documento["nombreEmpresa"];
                $this->pais = $documento["pais"];
                $this->direccion = $documento["direccion"];
                $this->logotipo = $documento["logotipo"];
                $this->telefono = $documento["telefono"];
                $this->banner = $documento["banner"];
                $this->redesSociales = $documento["redesSociales"];
                $this->refIdUsuario = $documento["refIdUsuario"];
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
    public function obtenerTodasEmpresas()
    {
        try {
            $query = $this->fs->obtenerTodosDocumentos();
            return $query;
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerEmpresaPorId()
    {
        try {
            $documento = $this->fs->getDocument($this->idEmpresa);
            $this->idEmpresa = $documento["id"];
            $this->nombreEmpresa = $documento["nombreEmpresa"];
            $this->pais = $documento["pais"];
            $this->direccion = $documento["direccion"];
            $this->logotipo = $documento["logotipo"];
            $this->telefono = $documento["telefono"];
            $this->banner = $documento["banner"];
            $this->redesSociales = $documento["redesSociales"];
            $this->refIdUsuario = $documento["refIdUsuario"];
            $respuesta["valido"] = true;
            $respuesta["mensaje"] = "Obtenido con exito";
            return $respuesta;
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }

    public function obtenerProductos()
    {
        $producto = new Producto();
        try {
            $query = $producto->obtenerProductoEmpresa($this->idEmpresa);
            $productos = array();
            if (!empty($query)) {
                foreach ($query as &$documento) {
                    $documento["logotipo"] = $this->logotipo;
                    $productos[] = $documento;
                }
                $respuesta["valido"] = true;
                $respuesta["productos"] = $productos;
                return $respuesta;
            } else {
                $respuesta["valido"] = false;
                $respuesta["mensaje"] = "Producto no encontrado";
                return $respuesta;
            }
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }

    public function obtenerSucursales()
    {
        $sucursal = new Sucursal();
        try {
            $query = $sucursal->obtenerSucursalEmpresa($this->idEmpresa);
            $sucursales = array();
            if (!empty($query)) {
                foreach ($query as &$documento) {
                    $sucursales[] = $documento;
                }
                $respuesta["valido"] = true;
                $respuesta["sucursales"] = $sucursales;
                return $respuesta;
            } else {
                $respuesta["valido"] = false;
                $respuesta["mensaje"] = "sucursal no encontrado";
                return $respuesta;
            }
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }

    public function obtenerPromociones()
    {
        $promocion = new Promocion();
        try {
            $query = $promocion->obtenerPromocionEmpresa($this->idEmpresa);
            $promociones = array();
            if (!empty($query)) {
                foreach ($query as &$documento) {
                    $documento["logotipo"] = $this->logotipo;
                    $promociones[] = $documento;
                }
                $respuesta["valido"] = true;
                $respuesta["promociones"] = $promociones;
                return $respuesta;
            } else {
                $respuesta["valido"] = false;
                $respuesta["mensaje"] = "Promoción no encontrada";
                return $respuesta;
            }
        } catch (Exception $e) {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = $e->getMessage();
            return $respuesta;
        }
    }

    public function actualizarEmpresa()
    {
        try {
            $this->fs->updateDocument($this->idEmpresa, [
                ['path' => 'nombreEmpresa', 'value' => $this->nombreEmpresa],
                ['path' => 'pais', 'value' => $this->pais],
                ['path' => 'direccion', 'value' => $this->direccion],
                ['path' => 'logotipo', 'value' => $this->logotipo],
                ['path' => 'telefono', 'value' => $this->telefono],
                ['path' => 'banner', 'value' => $this->banner],
                ['path' => 'redesSociales', 'value' => $this->redesSociales]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }
    public function eliminarEmpresa()
    {
        try {
            $this->fs->dropDocument($this->idEmpresa);
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function getIdUsuario()
    {
        return explode("/", $this->refIdUsuario)[1];
    }

    public function setIdUsuario($idUsuario)
    {
        $this->refIdUsuario = "Usuario/" . $idUsuario;
    }

    /**
     * Get the value of nombreEmpresa
     */
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * Set the value of nombreEmpresa
     *
     * @return  self
     */
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    /**
     * Get the value of pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of logotipo
     */
    public function getLogotipo()
    {
        return $this->logotipo;
    }

    /**
     * Set the value of logotipo
     *
     * @return  self
     */
    public function setLogotipo($logotipo)
    {
        $this->logotipo = $logotipo;

        return $this;
    }

    /**
     * Get the value of telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }


    /**
     * Get the value of banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set the value of banner
     *
     * @return  self
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get the value of redesSociales
     */
    public function getRedesSociales()
    {
        return $this->redesSociales;
    }

    /**
     * Set the value of redesSociales
     *
     * @return  self
     */
    public function setRedesSociales($redesSociales)
    {
        $this->redesSociales = $redesSociales;

        return $this;
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
}
//$empresa = new Empresa();
//$empresa->setTodo("diunsa@gmail.com", "Diunsa HN", "Honduras", "Col. Satelite, salida a la lima", "img4", "95987526", "img7", " Facebook");
//print_r($empresa->guardarEmpresa());
//print_r($empresa->obtenerPromociones("77dc2d7750a840949dbd"));
//print_r($empresa->getNombreEmpresa());
