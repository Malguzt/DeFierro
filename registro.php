<?php
include 'libs/incluidor.php';
include 'modelos/Usuario.php';

if(empty($_POST)) {
    ShowTemplate('registro_vista');
} else {
//Comprobando integridad del nombre de usuario.
    $clavesIguales = $_POST['clave'] == $_POST['clave2'];
    if($clavesIguales) {
        $nuevoUsuario = new Usuario($_POST['usuario'], $_POST['clave'], $_POST['email']);
        if($nuevoUsuario->guardar($db)) {
            ShowTemplate('index', array('mensajeCorrecto' => 'Usuario guardado con exito'));
        } else {
            ShowTemplate('registro', array('mensajeError' => $nuevoUsuario->buscarErrores($db)));
        }
    }else {
        ShowTemplate('registro', array('mensajeError' => 'Claves incompatibles.'));
    }
}

?>
