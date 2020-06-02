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
    private $token;
    private $fs;
    const HASH = PASSWORD_DEFAULT;
    const COST = 14;

    public function __construct()
    {
        $this->fs = new Firestore('Usuario');
    }

    public function setTodo(
        $correo,
        $cliente,
        $empresa,
        $superUsuario,
        $contrasena,
        $token
    ) {
        $this->correo = $correo;
        $this->cliente = $cliente;
        $this->empresa = $empresa;
        $this->superUsuario = $superUsuario;
        $this->contrasena = $contrasena;
        $this->token = $token;
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
                    'contrasena' => $hash,
                    'token' => $this->token
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
                $this->token = $documento["token"];
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
        //$hash = password_hash($this->contrasena,  self::HASH, ['cost' => self::COST]);
        try {
            $this->fs->updateDocument($this->idUsuario, [
                ['path' => 'cliente', 'value' => $this->cliente],
                ['path' => 'empresa', 'value' => $this->empresa],
                ['path' => 'superUsuario', 'value' => $this->superUsuario],
                ['path' => 'contrasena', 'value' => $this->contrasena],
                ['path' => 'correo', 'value' => $this->correo],
                ['path' => 'token', 'value' => $this->token]
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
            $this->fs->dropDocument($this->idUsuario); //eliminar las referencias 
            return '{"codigoResultado":"1","mensaje":"Eliminado con exito"}';
        } catch (Exception $e) {
            return '{"codigoResultado":"0","mensaje":"' . $e->getMessage() . '"}';
        }
    }

    public function existe($correo)
    {
        $documento = $this->fs->getWhere("correo", $correo);
        return !empty($documento);
    }

    public function login($correo, $contrasena)
    {
        $this->obtenerUsuario($correo);
        if (password_verify($contrasena, $this->contrasena)) {

            $respuesta["cliente"] = $this->cliente;
            $respuesta["empresa"] = $this->empresa;
            $respuesta["superUsuario"] = $this->superUsuario;
            $respuesta["valido"] = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            setcookie('correo',  $correo, time() + (86400 * 30), "/");
            setcookie('token',  $token, time() + (86400 * 30), "/");
            $this->token = $token;
            $this->actualizarUsuario();
        } else {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = "Contraeña incorrecta";
        }

        return $respuesta;
    }

    public static function logout()
    {
        setcookie('correo', "", time() - 3600, "/");
        setcookie('token', "", time() - 3600, "/");
        header("Location: ../index.html");
        //echo '{"mensaje" : "Cerrar Sesion"}';
    }

    public function verificarAutenticacion()
    {
        $this->obtenerUsuario($_COOKIE['correo']);
        if ($this->token == $_COOKIE['token']) {
            $respuesta["cliente"] = $this->cliente;
            $respuesta["empresa"] = $this->empresa;
            $respuesta["superUsuario"] = $this->superUsuario;
            $respuesta["valido"] = true;
        } else {
            $respuesta["valido"] = false;
        }
        return $respuesta;
    }
    public function verificarAutenticacionEmpresa()
    {
        $this->obtenerUsuario($_COOKIE['correo']);
        if ($this->empresa) {
            if ($this->token == $_COOKIE['token']) {
                return true;
            }
        }
        return false;
    }

    public function verificarAutenticacionCliente()
    {
        $this->obtenerUsuario($_COOKIE['correo']);
        if ($this->cliente) {
            if ($this->token == $_COOKIE['token']) {
                return true;
            }
        }
        return false;
    }
    public function verificarAutenticacionSuperUsuario()
    {
        $this->obtenerUsuario($_COOKIE['correo']);
        if ($this->superUsuario) {
            if ($this->token == $_COOKIE['token']) {
                return true;
            }
        }
        return false;
    }

    public function registro($confirmacionContraseña)
    {
        if ($this->contrasena == $confirmacionContraseña) {
            if (!$this->fs->existe($this->correo)) {
                $respuesta["token"] = bin2hex(openssl_random_pseudo_bytes(16));
                $this->token = $respuesta["token"];
                $this->guardarUsuario();
                $respuesta["cliente"] = $this->cliente;
                $respuesta["empresa"] = $this->empresa;
                $respuesta["superUsuario"] = $this->superUsuario;
                $respuesta["valido"] = true;
                $respuesta["correo"] = $this->correo;
                setcookie('correo',  $respuesta["correo"], time() + (86400 * 30), "/");
                setcookie('token',  $respuesta["token"], time() + (86400 * 30), "/");
            } else {
                $respuesta["valido"] = false;
                $respuesta["mensaje"] = "Correo ya registrado";
            }
        } else {
            $respuesta["valido"] = false;
            $respuesta["mensaje"] = "Contraseñas no coinciden";
        }
        return $respuesta;
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

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
