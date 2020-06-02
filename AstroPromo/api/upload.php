<?php
class SubidaImagen
{

    const RUTA = "img/";
    const RUTA_PERFIL = "img/perfil/";
    const RUTA_PORTADA = "img/portada/";
    const RUTA_LOGOTIPO = "img/logotipo/";
    const RUTA_BANNER = "img/banner/";
    const RUTA_PRODUCTO = "img/producto/";
    const RUTA_PROMOCION = "img/promocion/";
    const RUTA_SUCURSAL = "img/sucursal/";
    const RUTA_SUBIDA = "../img/";
    const RUTA_PERFIL_SUBIDA = "../img/perfil/";
    const RUTA_PORTADA_SUBIDA = "../img/portada/";
    const RUTA_LOGOTIPO_SUBIDA= "../img/logotipo/";
    const RUTA_BANNER_SUBIDA = "../img/banner/";
    const RUTA_PRODUCTO_SUBIDA = "../img/producto/";
    const RUTA_PROMOCION_SUBIDA = "../img/promocion/";
    const RUTA_SUCURSAL_SUBIDA = "../img/sucursal/";
    const EXTENSIONES_VALIDAS =  array("jpg", "jpeg", "png");

    public static function verificarExtension($archivo){
        $nombre = $archivo['name'];
        $tipoImagen = pathinfo($nombre, PATHINFO_EXTENSION);
        return in_array(strtolower($tipoImagen), SubidaImagen::EXTENSIONES_VALIDAS);
    }

    public static function subirFoto($ruta, $archivo){
        $nombre = $archivo['name'];
        $rutaImagen = $ruta.$nombre;
        return move_uploaded_file($archivo['tmp_name'], $rutaImagen);

    }
}
