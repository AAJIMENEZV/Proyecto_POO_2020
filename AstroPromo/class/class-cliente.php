<?php
require_once 'Firestore.php';

class Cliente
{
    private $idCliente;
    private $refIdUsuario;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $fotoPerfil;
    private $genero;
    private $numeroTelefono;
    private $numeroTarjeta;
    private $fotoPortada;
    private $fs;

    public function __construct()
    {
        $this->fs = new Firestore('Cliente');
    }

    public function setTodo(
        $nombre,
        $apellido,
        $fechaNacimiento,
        $fotoPerfil,
        $genero,
        $numeroTelefono,
        $numeroTarjeta,
        $fotoPortada,
        $idUsuario
    ) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->fotoPerfil = $fotoPerfil;
        $this->genero = $genero;
        $this->numeroTelefono = $numeroTelefono;
        $this->numeroTarjeta = $numeroTarjeta;
        $this->fotoPortada = $fotoPortada;
        $this->refIdUsuario = "/Usuario/".$idUsuario;
    }

    public function guardarCliente()
    {
        try {
            if (empty($this->fs->getWhere("refIdUsuario", $this->refIdUsuario))) {
                $this->idCliente = $this->fs->newDocument([
                    'nombre' => $this->nombre,
                    'apellido' => $this->apellido,
                    'fechaNacimiento' => $this->fechaNacimiento,
                    'fotoPerfil' => $this->fotoPerfil,
                    'genero' => $this->genero,
                    'numeroTelefono' => $this->numeroTelefono,
                    'numeroTarjeta' => $this->numeroTarjeta,
                    'fotoPortada' => $this->fotoPortada,
                    'refIdUsuario'=>$this->refIdUsuario
                ]);
                return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"Ya existe"}';
            }
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function obtenerCliente($idUsuario)
    {
        try {
            $query = $this->fs->getWhere("refIdUsuario", "/Usuario/".$idUsuario);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idCliente = $documento["id"];
                $this->nombre = $documento["nombre"];
                $this->apellido = $documento["apellido"];
                $this->fechaNacimiento = $documento["fechaNacimiento"];
                $this->fotoPerfil = $documento["fotoPerfil"];
                $this->genero = $documento["genero"];
                $this->numeroTelefono = $documento["numeroTelefono"];
                $this->numeroTarjeta = $documento["numeroTarjeta"];
                $this->fotoPortada = $documento["fotoPortada"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarCliente()
    {
        try {
            $this->fs->updateDocument($this->idCliente, [
                ['path' => 'nombre', 'value' => $this->nombre],
                ['path' => 'apellido', 'value' => $this->apellido],
                ['path' => 'fechaNacimiento', 'value' => $this->fechaNacimiento],
                ['path' => 'fotoPerfil', 'value' => $this->fotoPerfil],
                ['path' => 'genero', 'value' => $this->genero],
                ['path' => 'numeroTelefono', 'value' => $this->numeroTelefono],
                ['path' => 'numeroTarjeta', 'value' => $this->numeroTarjeta],
                ['path' => 'fotoPortada', 'value' => $this->fotoPortada]
            ]);
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }
    public function eliminarCliente()
    {
        try {
            $this->fs->dropDocument($this->idCliente);
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function getIdUsuario(){
        return explode("/",$this->refIdUsuario)[2];
    }

    public function setIdUsuario($idUsuario){
        $this->refIdUsuario = "/Usuario/".$idUsuario;
    }
    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of fechaNacimiento
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set the value of fechaNacimiento
     *
     * @return  self
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get the value of fotoPerfil
     */
    public function getFotoPerfil()
    {
        return $this->fotoPerfil;
    }

    /**
     * Set the value of fotoPerfil
     *
     * @return  self
     */
    public function setFotoPerfil($fotoPerfil)
    {
        $this->fotoPerfil = $fotoPerfil;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of numeroTelefono
     */
    public function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    /**
     * Set the value of numeroTelefono
     *
     * @return  self
     */
    public function setNumeroTelefono($numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;

        return $this;
    }

    /**
     * Get the value of numeroTarjeta
     */
    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    /**
     * Set the value of numeroTarjeta
     *
     * @return  self
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    /**
     * Get the value of fotoPortada
     */
    public function getFotoPortada()
    {
        return $this->fotoPortada;
    }

    /**
     * Set the value of fotoPortada
     *
     * @return  self
     */
    public function setFotoPortada($fotoPortada)
    {
        $this->fotoPortada = $fotoPortada;

        return $this;
    }



    /**
     * Get the value of correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

}

/*$cliente = new Cliente();
//$cliente->setTodo("jose@gmail.com", "Jose", "Pineda", "02/12/1998", "img4", "Masculino", "95987526", "0502060305", "img7");
//print_r($cliente->guardarCliente());
//print_r($cliente->obtenerCliente("jose@gmail.com"));
//print_r($cliente->getNombre());
$cliente->setFechaNacimiento("03/10/1996");
print_r($cliente->actualizarCliente());
//print_r($cliente->eliminarCliente('5c878d4885244dc79f78'));*/
$ref="/usuario/cualquiercosa";
print_r(explode("/",$ref));