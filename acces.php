<?php
include 'libs/including.php';
include 'models/User.php';

if(empty($_POST)) {
    ShowTemplate('user/acces');
} else {
    //Checking integrity of the user name.
    $user = new User($db);
    $user->setName($_POST['user']);
    $user->changePass($_POST['pass']);
    if($user->load()) {
        setcookie("UserName", $user->getName(), time()+7776000);
        setcookie("UserPass", $user->getPass(), time()+7776000);
        header("Location: index.php");
    } else {
        ShowTemplate('user/acces');
    }
}
?>