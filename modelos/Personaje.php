<?php
include 'Modelo.php';
class Personaje extends Modelo {
    private $id = 0;
    private $fuerza = 0;
    private $control_corporal = 0;
    private $agilidad = 0;
    private $flexibilidad = 0;
    private $inteligencia = 0;
    private $conocimiento = 0;
    private $memoria = 0;
    private $concentracion = 0;
    private $conviccion = 0;
    private $fluidez = 0;
    private $pinta = 0;
    private $expresividad = 0;
    private $oido = 0;
    private $gusto_olfato = 0;
    private $tacto = 0;
    private $vista = 0;
    private $control_materia = 0;
    private $control_mental = 0;
    private $control_planos = 0;
    private $aguye = 0;

    public function __construct() {
        parent::__construct();
    }
}
?>
