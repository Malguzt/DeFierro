<?php
include 'libs/incluidor.php';
include 'modelos/Usuario.php';

if(empty($_POST)) {
    ShowTemplate('acceso_vista');
} else {
    //Comprobando integridad del nombre de usuario.
    $elUsuario = new Usuario($_POST['usuario'], $_POST['clave']);
    if($elUsuario->cargar($db)) {
        setcookie("NombreUsuario", $elUsuario->getNombre(), time()+7776000);
        setcookie("ClaveUsuario", $elUsuario->getClave(), time()+7776000);
        header("Location: index.php");
    } else {
        ShowTemplate('acceso_vista');
    }
}
?>