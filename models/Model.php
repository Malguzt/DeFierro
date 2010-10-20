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
    
    function save($data = array())  {
        if(!empty($this->id)) $data['_id'] = $this->id;
        $this->setId($this->db->save($data, $this->model));
        return $this->getId();
    }

    /**
     * @param object id $id
     * @return Model
     */
    function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @return object id
     */
    function getId() {
        return $this->id;
    }

}

?>