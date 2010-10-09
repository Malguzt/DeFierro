<?php
    setcookie('NombreUsuario', null, time());
    setcookie('ClaveUsuario', null, time());
    header("Location: index.php");
?>