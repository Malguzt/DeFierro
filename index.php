<?php
    include 'libs/tiny.php';
    include 'modelos/Modelo.php';

    $miModelo = new Modelo();
    $miModelo->nuevaHectarea("José", "Arena");

    ShowTemplate('index', array('modelo' => $miModelo));
?>
