<?php
include 'libs/including.php';
include 'models/User.php';

if(empty($_POST)) {
    ShowTemplate('acces_view');
} else {
    //Comprobando integridad del nombre de usuario.
    $elUsuario = new Usuario($db, $_POST['usuario'], $_POST['clave']);
    if($elUsuario->cargar()) {
        setcookie("NombreUsuario", $elUsuario->getNombre(), time()+7776000);
        setcookie("ClaveUsuario", $elUsuario->getClave(), time()+7776000);
        header("Location: index.php");
    } else {
        ShowTemplate('acces_view');
    }
}
?>