<?php

require_once 'Model.php';

class Character extends Model {

    protected  $name = 'Juan Perez';
    static protected  $listOfAttributes = array(
        'fuerza',
        'coordinacionl',
        'agilidad',
        'flexibilidad',
        'inteligencia',
        'conocimiento',
        'memoria',
        'concentracion',
        'conviccion',
        'fluidez',
        'pinta',
        'expresividad',
        'oido',
        'gusto_olfato',
        'tacto',
        'vista',
        'control_materia',
        'control_mental',
        'control_planos'
    );
    protected $attributes = array();
    protected $aguye = 0;

    public function __construct($conexion, $nombre, $attributes = array()) {
        foreach (Character::listAttributes() as $attribute) {
            $this->attributes[$attribute] = rand(20, 60);
        }

        $this->aguye = rand(20, 60);
        parent::__construct($conexion);
    }

    function describirPJ() {
        return "Nombre: $this->nombre <br />
                Fuerza: $this->fuerza <br />
                Destrez: $this->destreza";
    }

    /**
     *
     * @return array Array with the list of the character attributes.
     */
    static function listAttributes(){
        return Character::$listOfAttributes;
    }

}

?>
