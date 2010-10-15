<?php

class DB{

    protected $db;

    function __construct() {
        $connection = new Mongo();
        $this->db = $connection->selectDB('DeFierro');
        return $this;
    }

    function insert($array, $model = 'default', $safe_insert = true){
        $collection = $this->db->selectCollection($model);
        $collection->insert($array, $safe_insert);
        return $data['_id'];
    }

    function save($array, $model = 'default', $safe_insert = true){
        $collection = $this->db->selectCollection($model);
        $collection->save($array, $safe_insert);
        return $data['_id'];
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
    //TODO: to work the count and ther methods
    function there($filter, $model = 'default'){
        $c = $this->find($model, $filter);
        var_dump($c);
        //return count($c) <> 0;
        return true;
    }

    function find($model = 'default', $filter = array()){
        $collection = $this->db->selectCollection($model);
        return $collection->find($filter);
    }

}

$db = new DB();

?>
