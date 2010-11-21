<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
    	<script type="text/javascript" src="libs/jquery.js" ></script>
		<script type="text/javascript" src="javascript/main.js" ></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>De Fierro Online</title>

        <link rel="STYLESHEET" type="text/css" href="template/general_style.css">
    </head>
    <body>
        <div id="encabezado">
            <div id="usuario">
            <?php if(isset($_COOKIE["UserName"])){
                echo $_COOKIE["UserName"];?>
                <a href="exit.php">Salir</a>
            <?}?>
            </div>
            <h1>De Fierro Online</h1>
        </div>
        <div id="mainArea">
            <div id="mensajes">
                <p id="errores"><?php echo isset($mensajeError)? $mensajeError: '';?></p>
                <p id="correctos"><?php echo isset($mensajeCorrecto)? $mensajeCorrecto: '';?></p>
            </div>
            <div id="loadArea">
            <?php echo $tiny_content; ?>
            </div>
        </div>
    </body>
</html>
