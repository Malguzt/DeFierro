<?php

require_once 'Model.php';

class Character extends Model {

    protected $name = 'Juan Perez';
    static protected $listOfAttributes = array(
        'Fuerza',
        'Coordinacion',
        'Agilidad',
        'Inteligencia',
        'Conocimiento',
        'Memoria',
        'Concentracion',
        'Fluidez',
        'Pinta',
        'Expresividad',
        'Oido',
        'Gusto/Olfato',
        'Tacto',
        'Vista',
        'Control materia',
        'Control mental',
        'Control planos'
    );
    protected $attributes = array();
    protected $aguye = 0;
    protected $model = 'character';

    public function __construct($db, $name, $attributes = array()) {
        /* Generating random values for attributes. */
        foreach (Character::listAttributes() as $attribute) {
            $this->attributes[$attribute] = rand(20, 60);
        }

        /* Generating random values for the preferred attributes. */
        foreach ($attributes as $index => $attribute) {
            $this->attributes[$attribute] = rand(60 - $index * 10, 100 - $index * 10);
        }

        $this->setName($name);

        $this->aguye = rand(0, 10);
        parent::__construct($db);
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
    static function listAttributes() {
        return Character::$listOfAttributes;
    }

    /**
     *
     * @return integer
     */
    function getId() {
        return $this->id;
    }

    function save($data = array()) {
        $data['name'] = $this->name;
        $data['attributes'] = $this->attributes;
        $data['aguye'] = $this->aguye;
        return parent::save($data);
    }

    function setName($name){
        $this->name = $name;
    }

}

?>
