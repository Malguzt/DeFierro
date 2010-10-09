<?php
include 'Model.php';
class Character extends Model {
    private $id;
    private $nombre = 'Juan Perez';
    private $fuerza = 0;
    private $coordinacionl = 0;
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

    public function __construct($conexion, $nombre, $atributos = array()) {
        $this->fuerza = rand(20, 60);
        $this->coordinacionl = rand(20, 60);
        $this->agilidad = rand(20, 60);
        $this->flexibilidad = rand(20, 60);
        $this->inteligencia = rand(20, 60);
        $this->conocimiento = rand(20, 60);
        $this->memoria = rand(20, 60);
        $this->concentracion = rand(20, 60);
        $this->conviccion = rand(20, 60);
        $this->fluidez = rand(20, 60);
        $this->pinta = rand(20, 60);
        $this->expresividad = rand(20, 60);
        $this->oido = rand(20, 60);
        $this->gusto_olfato = rand(20, 60);
        $this->tacto = rand(20, 60);
        $this->vista = rand(20, 60);
        $this->control_materia = rand(20, 60);
        $this->control_mental = rand(20, 60);
        $this->control_planos = rand(20, 60);
        $this->aguye = rand(20, 60);
        parent::__construct($conexion);
    }

    function describirPJ(){
        return "Nombre: $this->nombre <br />
                Fuerza: $this->fuerza <br />
                Destrez: $this->destreza";
    }


}
?>
