<?php
require_once 'Firestore.php';
class Usuario
{
    private $idUsuario;
    private $cliente;
    private $empresa;
    private $superUsuario;
    private $correo;
    private $contrasena;
    private $fs;

    public function __construct()
    {
        $this->fs = new Firestore('Usuario');
    }

    public function setTodo(
        $correo,
        $cliente,
        $empresa,
        $superUsuario,
        $contrasena
    ) {
        $this->correo = $correo;
        $this->cliente = $cliente;
        $this->empresa = $empresa;
        $this->superUsuario = $superUsuario;
        $this->contrasena = $contrasena;
    }


    public function guardarUsuario()
    {
        if (empty($this->fs->getWhere("correo", $this->correo))) {
            $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
            try {
                $this->idUsuario = $this->fs->newDocument([
                    'correo' => $this->correo,
                    'cliente' => $this->cliente,
                    'empresa' => $this->empresa,
                    'superUsuario' => $this->superUsuario,
                    'contrasena' => $hash
                ]);
                return '{"codigoResultado":"1","mensaje":"Guardado con exito"}';
            } catch (Exception $e) {

                return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
            }
        } else {
            return '{"codigoResultado":"0","mensaje":"Ya existe"}';
        }
    }

    public function obtenerUsuario($correo)
    {
        try {
            $query = $this->fs->getWhere("correo", $correo);
            if (!empty($query)) {
                $documento = $query[0];
                $this->idUsuario = $documento["id"];
                $this->correo = $correo;
                $this->cliente = $documento["cliente"];
                $this->empresa = $documento["empresa"];
                $this->superUsuario = $documento["superUsuario"];
                $this->contrasena = $documento["contrasena"];
                return '{"codigoResultado":"1","mensaje":"Obtenido con exito"}';
            } else {
                return '{"codigoResultado":"0","mensaje":"No encontrado"}';
            }
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function actualizarUsuario()
    {
        $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
        try {
            $this->fs->updateDocument($this->idUsuario, [
                ['path' => 'cliente', 'value' => $this->cliente],
                ['path' => 'empresa', 'value' => $this->empresa],
                ['path' => 'superUsuario', 'value' => $this->superUsuario],
                ['path' => 'contrasena', 'value' => $hash],
                ['path' => 'correo', 'value' => $this->correo]
            ]);
            //actualizar cliente, empresa y superusuario
            return '{"codigoResultado":"1","mensaje":"Actualizado con exito"}';
        } catch (Exception $e) {

            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }
    public function eliminarUsuario()
    {
        try {
            $this->fs->dropDocument($this->idUsuario);//eliminar las referencias 
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function login($correo, $contrasena)
    {
        if ($this->fs->existe($correo)) {
            $this->obtenerUsuario($correo);
            if (password_verify($contrasena, $this->contrasena)) {
                $respuesta["cliente"] = $this->cliente;
                $respuesta["empresa"] = $this->empresa;
                $respuesta["superUsuario"] = $this->superUsuario;
                $respuesta["valido"] = true;
                $respuesta["correo"] = $correo;
                $respuesta["token"] = bin2hex(openssl_random_pseudo_bytes(16));
            } else {
                $respuesta["valido"] = false;
            }
        } else {
            $respuesta["valido"] = false;
        }
        return json_encode($respuesta);
    }

    /**
     * Get the value of cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @return  self
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of empresa
     *
     * @return  self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get the value of superUsuario
     */
    public function getSuperUsuario()
    {
        return $this->superUsuario;
    }

    /**
     * Set the value of superUsuario
     *
     * @return  self
     */
    public function setSuperUsuario($superUsuario)
    {
        $this->superUsuario = $superUsuario;

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
     * Get the value of contrasena
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * Set the value of contrasena
     *
     * @return  self
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }
}
$usuario = new Usuario();
//$usuario->setTodo("josemm@gmail.com", "true", "false", "false", "asd.456");
//print_r($usuario->guardarUsuario());
print_r($usuario->obtenerUsuario("empresass@gmail.com"));
//print_r($usuario->getContrasena());
//print_r($usuario->eliminarUsuario('DpKWkxJIq3Tav2cr6BWP'));
//print_r($usuario->actualizarUsuario());
