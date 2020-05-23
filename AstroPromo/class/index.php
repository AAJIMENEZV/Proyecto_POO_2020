<?php
require_once 'Firestore.php';

$fs = new Firestore('Cliente');


//print_r($fs->getWhere('nombre', 'camisa'));
//print_r($fs->getCampos('San Pedro Sula'));
print_r($fs->newDocument(['Nombre' => 'LL','Apellido' => 'Lopez', 'Productos' => [["Nombre"=>"Pelota"],["Nombre"=>"Camisa","Descripcion"=>"Este es un comentario"]]]));
//print_r($fs->getDocument());
//print_r($fs->newCollection('test', 'Israel'));
//print_r($fs->dropDocument('Dublin'));
//print_r($fs->dropCollection('test'));
//print_r($fs->newSubCollection('San Pedro Sula','Salud'));  