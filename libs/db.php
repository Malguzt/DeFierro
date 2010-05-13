<?php
try {
    $db = new PDO('pgsql:dbname=' . $dbName . ';host=' . $host, $usuario, $clave);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch( PDOException $e ) {
    echo "Error de conexion: " . $e->getMessage();
}
?>
