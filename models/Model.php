<?php

/**
 * Generic class with the character common to all models.
 * Clase generica con las caracteristicas comunes a todos los modelo.
 *
 * @author Lenscak José Francisco
 */
abstract class Model {

    protected $db;
    protected $model = 'root';
    protected $id;

    public function __construct($db) {
        $this->db = $db;
    }
    
    function save($data = array()) {
        if(!empty($this->id)) $data['__id'] = $this->id;
        try {
            $this->setId($this->db->save($data, $this->model));
        } catch (MongoCursorException $e){
            return false;
        }
        return true;
    }

    function setId($id){
        $this->id = $id;
    }

}

?>