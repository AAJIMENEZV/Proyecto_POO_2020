<?php

class Administrador{
    private $usuarioAdmin;
    private $contrasenaAdmin;
    
    function __construct($usuarioAdmin, $contrasenaAdmin) {
        $this->usuarioAdmin = $usuarioAdmin;
        $this->contrasenaAdmin = $contrasenaAdmin;
    }

    function getUsuarioAdmin() {
        return $this->usuarioAdmin;
    }

    function getContrasenaAdmin() {
        return $this->contrasenaAdmin;
    }

    function setUsuarioAdmin($usuarioAdmin) {
        $this->usuarioAdmin = $usuarioAdmin;
    }

    function setContrasenaAdmin($contrasenaAdmin) {
        $this->contrasenaAdmin = $contrasenaAdmin;
    }


}