<?php
include 'libs/including.php';
include 'models/User.php';

if(empty($_POST)) {
    ShowTemplate('registration_view');
} else {
//Checking integrity of the username.
    $equalsKeys = $_POST['pass'] == $_POST['pass2'];
    if($equalsKeys) {
        $newUser = new User($db, $_POST['user'], $_POST['pass'], $_POST['email']);
        if($newUser->save()) {
            ShowTemplate('index_view', array('mensajeCorrecto' => 'Usuario guardado con exito'));
        } else {
            ShowTemplate('registration_view', array('mensajeError' => $newUser->buscarErrores()));
        }
    }else {
        ShowTemplate('registration_view', array('mensajeError' => 'Claves incompatibles.'));
    }
}

?>
