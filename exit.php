<?php
    setcookie('UserName', null, time());
    setcookie('UserPass', null, time());
    header("Location: index.php");
?>