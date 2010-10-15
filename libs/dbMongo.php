<?php

class DB{

    protected $db;

    function __construct() {
        $connection = new Mongo();
        $this->db = $connection->selectDB('defierro');
        return $this;
    }

    function insert($array, $model = 'default', $safe_insert = true){
        $collection = $this->db->selectCollection($model);
        $collection->insert($array, $safe_insert);
        return $data['_id'];
    }

    function save($array, $model = 'default', $options = array('safe' => true)){
        $collection = $this->db->selectCollection($model);
        $collection->save($array, $options);
        return $array['_id'];
    }

    function update($filter, $new_document, $model = 'default', $options = array()){
        $collection = $this->db->selectCollection($model);
        $options['multiple'] = false;
        $collection->update(
                    $filter,
                    $new_document,
                    $options
            );
    }
    
    function exist($filter, $model = 'default'){
        $collection = $this->db->selectCollection($model);
        return $collection->count($filter) <> 0;
    }

    function find($model = 'default', $filter = array()){
        $collection = $this->db->selectCollection($model);
        return $collection->find($filter);
    }

}

$db = new DB();

?>
