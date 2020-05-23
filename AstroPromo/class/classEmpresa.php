<?php

class Empresa{
    private $idEmpresa;
    private $nombreEmpresa;
    private $pais;
    private $direccion;
    private $longitud;
    private $latitud;
    private $banner;
    private $logotipo;
    private $redesSociales;
    private $usuarioEmpresa;
    private $contrasenaEmpresa;
    private $sucursales;
    
    function __construct($nombreEmpresa, $pais, $direccion, $longitud, $latitud, $banner, $logotipo, $redesSociales, $usuarioEmpresa, $contrasenaEmpresa, $sucursales) {
        $this->nombreEmpresa = $nombreEmpresa;
        $this->pais = $pais;
        $this->direccion = $direccion;
        $this->longitud = $longitud;
        $this->latitud = $latitud;
        $this->banner = $banner;
        $this->logotipo = $logotipo;
        $this->redesSociales = $redesSociales;
        $this->usuarioEmpresa = $usuarioEmpresa;
        $this->contrasenaEmpresa = $contrasenaEmpresa;
        $sucursales = new Sucursal();
    }

        function getIdEmpresa() {
        return $this->idEmpresa;
    }

    function getNombreEmpresa() {
        return $this->nombreEmpresa;
    }

    function getPais() {
        return $this->pais;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function getBanner() {
        return $this->banner;
    }

    function getLogotipo() {
        return $this->logotipo;
    }

    function getRedesSociales() {
        return $this->redesSociales;
    }

    function getUsuarioEmpresa() {
        return $this->usuarioEmpresa;
    }

    function getContrasenaEmpresa() {
        return $this->contrasenaEmpresa;
    }

    function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setNombreEmpresa($nombreEmpresa) {
        $this->nombreEmpresa = $nombreEmpresa;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    function setBanner($banner) {
        $this->banner = $banner;
    }

    function setLogotipo($logotipo) {
        $this->logotipo = $logotipo;
    }

    function setRedesSociales($redesSociales) {
        $this->redesSociales = $redesSociales;
    }

    function setUsuarioEmpresa($usuarioEmpresa) {
        $this->usuarioEmpresa = $usuarioEmpresa;
    }

    function setContrasenaEmpresa($contrasenaEmpresa) {
        $this->contrasenaEmpresa = $contrasenaEmpresa;
    }
    function getSucursales() {
        return $this->sucursales;
    }

    function setSucursales($sucursales) {
        $this->sucursales = $sucursales;
    }

        
        
      public function crearEmpresa($db){
            $empresas = $this->getData();
            $result= $db->getReference('empresa')
                    ->push($empresas);
            $result->getKey();
        }
        
               public function actualizarEmpresa ($db, $id){
            $db->getReference('empresa')
               ->getChild($id)
               ->set($this->getData());
           
        }
                public static function eliminarEmpresa($db, $id){
            $db->getReference('empresa')
                    ->getChild($id)
                    ->remove();
            echo 'Mensaje: Se elimino correctamente';
        }
        
                public function getData(){
            $result['nombreEmpresa'] = $this->nombreEmpresa;
            $result['pais'] = $this->pais;
            $result['direccion'] = $this->direccion;
            $result['longitud'] = $this->longitud;
            $result['latitud'] = $this->latitud;
            $result['banner'] = $this->banner;
            $result['logotipo'] = $this->logotipo;
            $result['redesSociales'] = $this->redesSociales;
            $result['usuarioEmpresa'] = $this->usuarioEmpresa;
                $result['contrasenaEmpresa'] = $this->contrasenaEmpresa;   
                $result['sucursales'] = $this->sucursales ;
            return $result;
        }
        
        public static function obtenerEmpresas($db){
            $result = $db->getReference('empresa')
                    ->getSnapshot()
                    ->getValue();
            echo json_encode($result) ;
            }
        public static function obtenerEmpresa($db, $id){
            $result = $db->getReference('empresa')
                    ->getChild($id)
                    ->getValue();
                echo json_encode($result);
        }


}