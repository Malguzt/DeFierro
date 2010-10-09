<?php
include 'libs/including.php';
include 'models/User.php';

if(empty($_POST)) {
    ShowTemplate('registratopm_view');
} else {
//Comprobando integridad del nombre de usuario.
    $clavesIguales = $_POST['clave'] == $_POST['clave2'];
    if($clavesIguales) {
        $nuevoUsuario = new Usuario($db, $_POST['usuario'], $_POST['clave'], $_POST['email']);
        if($nuevoUsuario->guardar()) {
            ShowTemplate('index', array('mensajeCorrecto' => 'Usuario guardado con exito'));
        } else {
            ShowTemplate('registro', array('mensajeError' => $nuevoUsuario->buscarErrores()));
        }
    }else {
        ShowTemplate('registro', array('mensajeError' => 'Claves incompatibles.'));
    }
}

?>
