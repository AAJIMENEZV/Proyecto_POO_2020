<?php

class Cliente {

    private $idCliente;
    private $nombreCliente;
    private $apellidoCliente;
    private $correoCliente;
    private $usuarioCliente;
    private $fechaNacimiento;
    private $genero;
    private $telefonoCliente;
    private $fotoCLiente;
    private $contrasenaCliente;

    function __construct($nombreCliente, $apellidoCliente, $correoCliente, $usuarioCliente, $fechaNacimiento, $genero, $telefonoCliente, $fotoCLiente, $contrasenaCliente) {
        $this->nombreCliente = $nombreCliente;
        $this->apellidoCliente = $apellidoCliente;
        $this->correoCliente = $correoCliente;
        $this->usuarioCliente = $usuarioCliente;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
        $this->telefonoCliente = $telefonoCliente;
        $this->fotoCLiente = $fotoCLiente;
        $this->contrasenaCliente = $contrasenaCliente;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getNombreCliente() {
        return $this->nombreCliente;
    }

    function getApellidoCliente() {
        return $this->apellidoCliente;
    }

    function getCorreoCliente() {
        return $this->correoCliente;
    }

    function getUsuarioCliente() {
        return $this->usuarioCliente;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getTelefonoCliente() {
        return $this->telefonoCliente;
    }

    function getFotoCLiente() {
        return $this->fotoCLiente;
    }

    function getContrasenaCliente() {
        return $this->contrasenaCliente;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }

    function setApellidoCliente($apellidoCliente) {
        $this->apellidoCliente = $apellidoCliente;
    }

    function setCorreoCliente($correoCliente) {
        $this->correoCliente = $correoCliente;
    }

    function setUsuarioCliente($usuarioCliente) {
        $this->usuarioCliente = $usuarioCliente;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setTelefonoCliente($telefonoCliente) {
        $this->telefonoCliente = $telefonoCliente;
    }

    function setFotoCLiente($fotoCLiente) {
        $this->fotoCLiente = $fotoCLiente;
    }

    function setContrasenaCliente($contrasenaCliente) {
        $this->contrasenaCliente = $contrasenaCliente;
    }

    public function crearCliente($db) {
        $clientes = $this->getData();
        $result = $db->getReference('cliente')
                ->push($clientes);
        $result->getKey();
    }

    public function actualizarCliente($db, $id) {
        $db->getReference('cliente')
                ->getChild($id)
                ->set($this->getData());
    }

    public static function eliminarCliente($db, $id) {
        $db->getReference('cliente')
                ->getChild($id)
                ->remove();
        echo 'Mensaje: Se elimino correctamente';
    }

    public function getData() {
        $result['nombreCliente'] = $this->nombreCliente;
        $result['apellidoCliente'] = $this->apellidoCliente;
        $result['correoCliente'] = $this->correoCliente;
        $result['usuarioCliente'] = $this->usuarioCliente;
        $result['fechaNacimiento'] = $this->fechaNacimiento;
        $result['genero'] = $this->genero;
        $result['telefonoCliente'] = $this->telefonoCliente;
        $result['fotoCliente'] = $this->fotoCliente;
        $result['contrasenaCliente'] = password_hash($this->contrasenaCliente, PASSWORD_DEFAULT);
        return $result;
    }

    public static function obtenerClientes($db) {
        $result = $db->getReference('cliente')
                ->getSnapshot()
                ->getValue();
        echo json_encode($result);
    }

    public static function obtenerCliente($db, $id) {
        $result = $db->getReference('cliente')
                ->getChild($id)
                ->getValue();
        echo json_encode($result);
    }

    public static function login($user, $password, $db) {

        $resultado = $db->getReference('cliente')
                ->orderByChild('usuario-cliente')
                ->equalTo($user)
                ->getSnapshot()
                ->getValue();
        $key = array_key_first($resultado);

        $valido = password_verify("admin3", $resultado[$key]['contrasena-cliente']);
        
        $respuesta['valido']=$valido==1?true:false;
        if($respuesta["valido"]){
        $respuesta['key']=$key;
        $respuesta['key']=$resultado[$key]['usuario-cliente'];
        $respuesta['token']= bin2hex(openssl_random_pseudo_bytes(16));
        setcookie('key',$respuesta["key"],time()+(86400*30),"/");
          setcookie('key',$respuesta["email"],time()+(86400*30),"/");      
        setcookie('key',$respuesta["token"],time()+(86400*30),"/");
        
        }
        echo json_encode($respuesta);
    }

}
