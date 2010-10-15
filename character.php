<?php

require 'libs/including.php';
require 'models/User.php';
require 'models/Character.php';

$user = new User($db, $_COOKIE['UserName'], $_COOKIE['UserPass']);
$user->load();
if ($user->hasCharacter()) {

} else {
    if (empty($_POST)) {
        ShowTemplate("create_character", array('attributes' => Character::listAttributes()));
    }
}
?>
