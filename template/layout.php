<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>De Fierro Online</title>

        <link rel="STYLESHEET" type="text/css" href="template/general_style.css">
    </head>
    <body>
        <div id="encabezado">
            <div id="usuario">
            <?php if(isset($_COOKIE["NombreUsuario"])){
                echo $_COOKIE["NombreUsuario"];?>
                <a href="salir.php">Salir</a>
            <?}?>
            </div>
            <h1>De Fierro Online</h1>
        </div>
        <div id="menuIzquierdo">
            <ul>
                <li><a href="acceso.php">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            <?php if(isset($_COOKIE["NombreUsuario"])){?>
                <li><a href="personaje.php">Personaje</a></li>
            <?}?>
            </ul>
        </div>
        <div id="areaPrincipal">
            <div id="mensajes">
                <p id="errores"><?php echo isset($mensajeError)? $mensajeError: '';?></p>
                <p id="correctos"><?php echo isset($mensajeCorrecto)? $mensajeCorrecto: '';?></p>
            </div>
            <?php echo $tiny_content; ?>
        </div>
    </body>
</html>
