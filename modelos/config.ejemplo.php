<?php
    $host = ''; //Dirección del host donde se encuentra la DB
    $usuario = '';
    $clave = '';
    $dbName = ''; //Nombre de la base de datos con la que se va a trabajar.
    try {
        $db = new PDO('mysql:dbname=' . Modelo::$dbName . ';host=' . Modelo::$host, Modelo::$usuario, Modelo::$clave);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch( PDOException $e ) {
            echo "Error de conexion: " . $e->getMessage();
    }

?>