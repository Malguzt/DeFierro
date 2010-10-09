<?php
    include 'libs/including.php';
    include 'models/User.php';
    if(isset($_COOKIE["UserName"])){
        ShowTemplate('index_view');
    } else {
        header("Location: acces.php");
    }
?>
