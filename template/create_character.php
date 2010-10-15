<?php //$atributos = array('Aguye', 'Fuerza', 'Control_corporal', 'Agilidad', 'Flexibilidad', 'Inteligencia', 'Conocimiento', 'Memoria','Consentración', 'Convicción', 'Fluidez', 'Pinta', 'Expresividad', 'Oido', 'Gusto/Olfato', 'Tacto', 'Vista');?>
<p>Bienvenido paisano, todos sabemos que tu mundo es un lugar injusto, y por estos pagos no hay diferente. Así que elige cuales son tus habilidades preferidas y rezale a tata-dios para que te de lo mejor de ellas.</p>
<form name="crearPersonaje" action="personaje.php" method="POST">
    <p>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" value="Juan Perez" size="30" />
    </p>

    <?php for($i = 1; $i <= 5; $i++) { ?>
        <p>
            <label for="atributo<?php echo $i ?>"><?php echo $i ?>º</label>
            <select name="atributo<?php echo $i ?>">
                <?php foreach($attributes as $attribute) { ?>
                    <option><?php echo $attribute?></option>
                <?php } ?>
            </select>
        </p>
    <?php } ?>
    <p>
        <input type="submit" value="Crear PJ" name="crear" />
        <input type="reset" value="Borrar" name="borrar" />
    </p>
</form>
