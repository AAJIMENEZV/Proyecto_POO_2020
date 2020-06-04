<?php
require_once 'Firestore.php';
class Producto
{
     private $idProducto;
     private $nombreProducto;
     private $descripcion;
     private $precio;
     private $fotoProducto;
     private $refIdEmpresa;
     private $fs;


     

     public function __construct()
     {
          $this->fs = new Firestore('Producto');
     }



     public function setTodo(
          $nombreProducto,
          $descripcion,
          $precio,
          $fotoProducto,
          $idEmpresa
     ) {
          $this->nombreProducto = $nombreProducto;
          $this->descripcion = $descripcion;
          $this->precio = $precio;
          $this->fotoProducto = $fotoProducto;
          $this->refIdEmpresa = "Empresa/" . $idEmpresa;
     }

     public function guardarProducto()
     {
          try {
               $this->idProducto = $this->fs->newDocument([
                    'nombreProducto' => $this->nombreProducto,
                    'descripcion' => $this->descripcion,
                    'precio' => $this->precio,
                    'fotoProducto' => $this->fotoProducto,
                    'refIdEmpresa' => $this->refIdEmpresa
               ]);
               return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
          } catch (Exception $e) {

               return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
          }
     }

     public function obtenerProducto($idProducto)
     {
          try {
               $query = $this->fs->getWhere("idProducto",$idProducto);
               if (!empty($query)) {
                    $documento = $query[0];
                    $this->idProducto = $documento["id"];
                    $this->nombreProducto = $documento["nombreProducto"];
                    $this->descripcion = $documento["descripcion"];
                    $this->precio = $documento["precio"];
                    $this->fotoProducto = $documento["fotoProducto"];
                    return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
               } else {
                    return '{"codigoResultado":"0","mensaje":"No encontrado"}';
               }
          } catch (Exception $e) {
               return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
          }
     }

     public function obtenerProductoEmpresa($idEmpresa)
    {
        try {
            $query = $this->fs->getWhere("refIdEmpresa", "Empresa/" . $idEmpresa);
            return $query;
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

     public function actualizarProducto()
     {
          try {
               $this->fs->updateDocument($this->idProducto, [
                    ['path' => 'nombreProducto', 'value' => $this->nombreProducto],
                    ['path' => 'descripcion', 'value' => $this->descripcion],
                    ['path' => 'precio', 'value' => $this->precio],
                    ['path' => 'fotoProducto', 'value' => $this->fotoProducto]
               ]);
               return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
          } catch (Exception $e) {

               return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
          }
     }
     public function eliminarProducto()
     {
          try {
               $this->fs->dropDocument($this->idProducto);
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
      * Get the value of nombreProducto
      */
     public function getNombreProducto()
     {
          return $this->nombreProducto;
     }

     /**
      * Set the value of nombreProducto
      *
      * @return  self
      */
     public function setNombreProducto($nombreProducto)
     {
          $this->nombreProducto = $nombreProducto;

          return $this;
     }

     /**
      * Get the value of descripcion
      */
     public function getDescripcion()
     {
          return $this->descripcion;
     }

     /**
      * Set the value of descripcion
      *
      * @return  self
      */
     public function setDescripcion($descripcion)
     {
          $this->descripcion = $descripcion;

          return $this;
     }

     /**
      * Get the value of precio
      */
     public function getPrecio()
     {
          return $this->precio;
     }

     /**
      * Set the value of precio
      *
      * @return  self
      */
     public function setPrecio($precio)
     {
          $this->precio = $precio;

          return $this;
     }

     /**
      * Get the value of fotoProducto
      */
     public function getFotoProducto()
     {
          return $this->fotoProducto;
     }

     /**
      * Set the value of fotoProducto
      *
      * @return  self
      */
     public function setFotoProducto($fotoProducto)
     {
          $this->fotoProducto = $fotoProducto;

          return $this;
     }
}
