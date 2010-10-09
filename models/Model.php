<?php

/**
 * Generic class with the character common to all models.
 * Clase generica con las caracteristicas comunes a todos los modelo.
 *
 * @author Lenscak José Francisco
 */
abstract class Model {

    protected $collection;
    protected $model = 'root';

    public function __construct($db) {
        $this->collection = $db->selectCollection($this->model);
    }

    function save() {
        $safe_insert = true;
        $data = $this->toArray($this);
        $this->collection->insert($data, $safe_insert);
    }

    function toArray($object) {
        if (is_array($object) || is_object($object)) {
            $array = array();
            foreach ($object as $key => $value) {
                $array[$key] = $this->toArray($value);
            }
            return $array;
        }
        return $object;
    }

}

?>