<?php

require_once 'Model.php';

class Character extends Model {

    protected $name;
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

    /**
     * @return Character
     */
    function generateAttributes(){
        /* Generating random values for attributes. */
        foreach (Character::listAttributes() as $attribute) {
            $this->setAttribute($attribute, rand(20, 60));
        }
        return $this;
    }

    /**
     * @param array $attributes
     * @return Character
     */
    function generatePreferredAtributes($attributes){
        /* Generating random values for the preferred attributes. */
        foreach ($attributes as $index => $attribute) {
            $this->setAttribute($attribute, rand(60 - $index * 10, 100 - $index * 10));
        }
        return $this;
    }

    function setAttribute($attribute, $value){
        $this->attributes[$attribute] = $value;
        return $this;
    }

    /**
     * @return Character
     */
    function generateAguye(){
        $this->aguye = rand(0, 10);
        return $this;
    }

    /**
     * @return array Array with the list of the character attributes.
     */
    static function listAttributes() {
        return Character::$listOfAttributes;
    }

    /**
     * @return ObjectId
     */
    function getId() {
        return $this->id;
    }

    /**
     * @param array $data
     * @return ObjectId
     */
    function save($data = array()) {
        $data['name'] = $this->name;
        $data['attributes'] = $this->attributes;
        $data['aguye'] = $this->aguye;
        return parent::save($data);
    }

    /**
     * @param string $name
     */
    function setName($name){
        $this->name = $name;
    }

    /**
     * @return array 
     */
    function getDescription(){
        return $description = array(
            'name' => $this->name,
            'aguye' => $this->getAguye(),
            'attributes' => $this->getAttributes(),
        );
    }

    /**
     * @return array
     */
    function getAttributes(){
        return $this->attributes;
    }

    /**
     * @return integer
     */
    function getAguye(){
       return $this->aguye;
    }

    function setAguye($aguye){
        $this->aguye = $aguye;
    }

    function load(){
        $filter = array('_id' => $this->getId());
        $character = $this->db->findOne($this->model, $filter);
        $this->setName($character['name']);
        $this->setAguye($character['aguye']);
        foreach ($character['attributes'] as $attribute => $value){
            $this->setAttribute($attribute, $value);
        }
        return $this;
    }

}

?>
