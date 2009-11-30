<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>De Fierro Online</title>

        <link rel="STYLESHEET" type="text/css" href="template/estilo_general.css">
    </head>
    <body>
        <div id="encabezado"><h1>De Fierro Online</h1></div>
        <div id="menuIzquierdo">
            <ul>
                <li><a href="login.php">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="personaje.php">Personaje</a></li>
            </ul>
        </div>
        <div id="areaPrincipal">
            <?php echo $tiny_content; ?>
        </div>
    </body>
</html>
