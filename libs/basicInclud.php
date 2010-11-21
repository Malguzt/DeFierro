<?php
include 'config.php';
    require_once 'dbMongo.php';
    function __autoload($class_name) {
    	try {
    		require_once 'models/' . $class_name . '.php';
    	} catch (Exception $e){
    		require_once 'view/' . $class_name . '.php';
    	}
	}
?>