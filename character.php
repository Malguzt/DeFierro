<?php

require 'libs/including.php';
require 'models/User.php';
require 'models/Character.php';
$user = new User($db);
$user->setName($_COOKIE['UserName']);
$user->setPass($_COOKIE['UserPass']);
$user->load();
if ($user->hasCharacter()) {
    ShowTemplate('character_view', array('description' => $user->getCharacter()->getDescription()));
} else {
    if (empty($_POST)) {
        ShowTemplate("create_character", array('attributes' => Character::listAttributes()));
    } else {
        $attributes = array();
        for ($i = 0; $i < 5; $i++) {
            $attributes[$i] = $_POST['attribute' . $i];
        }
        $newCharacter = new Character($db);
        $newCharacter->setName($_POST['name']);
        $newCharacter->generateAttributes();
        $newCharacter->generatePreferredAtributes($attributes);
        $newCharacter->generateAguye();
        $user->setCharacter($newCharacter);
        $user->save();
        ShowTemplate('character_view',  array('description' => $user->getCharacter()->getDescription()));
    }
}
?>
