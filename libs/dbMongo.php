<?php
    /** Script of mongoDB conection.*/
    $connection = new Mongo();
    $db = $connection->selectDB($dbName);
?>