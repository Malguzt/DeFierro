<?php
include 'libs/including.php';
include 'models/User.php';

if(empty($_POST)) {
    ShowTemplate('user/registration');
} else {
//Checking integrity of the username.
    $equalsKeys = $_POST['pass'] == $_POST['pass2'];
    if($equalsKeys) {
        $newUser = new User($db);
        $newUser->setName($_POST['user']);
        $newUser->changePass($_POST['pass']);
        $newUser->setEmail($_POST['email']);
        if($newUser->validateUser() && $newUser->save()) {
            ShowTemplate('index_view', array('mensajeCorrecto' => 'Usuario guardado con exito'));
        } else {
            ShowTemplate('user/registration', array('mensajeError' => $newUser->findErrors()));
        }
    }else {
        ShowTemplate('user/registration', array('mensajeError' => 'Claves incompatibles.'));
    }
}

?>
