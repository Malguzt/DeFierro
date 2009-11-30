<?php
include 'libs/incluidor.php';
include 'modelos/Usuario.php';

if(empty($_POST)) {
    ShowTemplate('registro');
} else {
//Comprobando integridad del nombre de usuario.
    $clavesIguales = $_POST['clave'] == $_POST['clave2'];
    if($clavesIguales) {
        $nuevoUsuario = new Usuario($_POST['usuario'], $_POST['clave'], $_POST['email']);
        if($nuevoUsuario->guardar($db)) {
            echo 'Usuario guardado con exito';
            ShowTemplate('index');
        } else {
            echo 'Error al guardar el usuario';
            ShowTemplate('registro');
        }
    }else {
        echo 'Error al guardar el usuario';
        ShowTemplate('registro');
    }
}

?>
