<?php
//Comentario idiota de nuevo
    include 'libs/incluidor.php';
    include 'modelos/Usuario.php';
    if(isset($_COOKIE["NombreUsuario"])){
        ShowTemplate('index_vista');
    } else {
        header("Location: acceso.php");
    }
?>
