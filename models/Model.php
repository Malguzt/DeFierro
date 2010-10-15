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
    //TODO: to work the save method
    function save($data = array()) {
        if(!empty($this->id)) $data['__id'] = $this->id;
        try {
            $this->id = $this->db->save($data, $this->model);
        } catch (MongoCursorException $e){
            return false;
        }
        return true;
    }

}

?>