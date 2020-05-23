<?php
require_once 'Firestore.php';
class Promocion{
    private $idPromocion;
    private $nombrePromocion;
    private $descripcionPromocion;
    private $imagenPromocion;
    private $idProducto;
    private $descuento;
    private $precioNormal;
    private $precioPromocion;
    private $fechaVencimiento;
    private $fechaInicio;
    private $idEmpresa;

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
        $precioPromocion,
        $fechaVencimiento,
        $fechaInicio,
        $idEmpresa
    )
    {
        $this->nombrePromocion=$nombrePromocion;
        $this->descripcionPromocion=$descripcionPromocion;
        $this->imagenPromocion=$imagenPromocion;
        $this->idProducto=$idProducto;
        $this->descuento=$descuento;
        $this->precioNormal=$precioNormal;
        $this->precioPromocion=$precioPromocion;
        $this->fechaVencimiento=$fechaVencimiento;
        $this->fechaInicio=$fechaInicio;
        $this->idEmpresa=$idEmpresa;
    }       

    public function guardarPromocion(){
        try{
            $this->idPromocion =$this->fs->newDocument([
                 'nombrePromocion'=>$this->nombrePromocion ,
                 'descripcionPromocion'=>$this->descripcionPromocion,
                 'imagenPromocion'=>$this->imagenPromocion,
                 'idProducto'=>$this->idProducto,
                 'descuento'=>$this->descuento,
                 'precioNormal'=>$this->precioNormal ,
                 'precioPromocion'=>$this->precioPromocion,
                 'fechaVencimiento'=>$this->fechaVencimiento,
                 'fechaInicio'=>$this->fechaInicio,
                 'idEmpresa'=>$this->idEmpresa
                 ]);
             return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
         }catch(Exception $e){
             
             return'{"codigoResultado":"0","mensaje":"'.$e->getMessage().'"}';
         }
   }

   public function obtenerPromocion($idPromocion){
        try{
            $documento = $this->fs->getDocument($idPromocion);
            $this->idPromocion=$idPromocion;
            $this->nombrePromocion=$documento["nombrePromocion"];
            $this->descripcionPromocion=$documento["descripcionPromocion"];
            $this->imagenPromocion=$documento["imagenPromocion"];
            $this->idProducto=$documento["idProducto"];
            $this->descuento=$documento["descuento"];
            $this->precioNormal=$documento["precioNormal"];
            $this->precioPromocion=$documento["precioPromocion"];
            $this->fechaVencimiento=$documento["fechaVencimiento"];
            $this->fechaInicio=$documento["fechaInicio"];
            $this->idEmpresa=$documento["idEmpresa"];
            return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
        }catch(Exception $e){
            return '{"codigoResultado":"0","mensaje":"'.$e->getMessage().'"}';
        }
    }

    public function actualizarPromocion(){
        try{
            $this->fs->updateDocument($this->idPromocion,[
                ['path' => 'nombrePromocion', 'value' => $this->nombrePromocion],
                ['path' => 'descripcionPromocion', 'value' => $this->descripcionPromocion],
                ['path' => 'imagenPromocion', 'value' => $this->imagenPromocion],
                ['path' => 'idProducto', 'value' => $this->idProducto],
                ['path' => 'descuento', 'value' => $this->descuento],
                ['path' => 'precioNormal', 'value' => $this->precioNormal],
                ['path' => 'precioPromocion', 'value' => $this->precioPromocion],
                ['path' => 'fechaVencimiento', 'value' => $this->fechaVencimiento],
                ['path' => 'fechaInicio', 'value' => $this->fechaInicio],
                ['path' => 'idEmpresa', 'value' => $this->idEmpresa]
                ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        }catch(Exception $e){
            
            return'{"codigoResultado":"0","mensaje":"'.$e->getMessage().'"}';
        }
    }
    public function eliminarPromocion($idPromocion){
        try{
            $this->fs->dropDocument($idPromocion);
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        }catch(Exception $e){
            return'{"codigoResultado":"0","mensaje":"'.$e->getMessage().'"}';
        }
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
     * Get the value of precioPromocion
     */ 
    public function getPrecioPromocion()
    {
        return $this->precioPromocion;
    }

    /**
     * Set the value of precioPromocion
     *
     * @return  self
     */ 
    public function setPrecioPromocion($precioPromocion)
    {
        $this->precioPromocion = $precioPromocion;

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

    /**
     * Get the value of idProducto
     */ 
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of idProducto
     *
     * @return  self
     */ 
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

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
