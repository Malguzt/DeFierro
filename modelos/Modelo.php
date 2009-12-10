<?php
/**
 * Clase generica con las caracteristicas comunes a todos los modelo.
 *
 * @author Lenscak José Francisco
 */
abstract class Modelo {
    protected $tabla;

    public function __construct(){

    }

    protected function guardar($arreglo, $conexion) {
        $valores = array();
        $campos = '';
        /**
         * @internal Variable para almacenar la cantidad de signos de interrogación necesaria.
         */
        $signos = '';
        $separador = '';
        foreach ($arreglo as $campo => $valor) {
            $campos .= $separador.$campo;
            $signos .= $separador.'?';
            $separador = ', ';

            array_push($valores, $valor);
        }
        $sentencia = $conexion->prepare("INSERT INTO usuario ($campos) VALUES ($signos)");
        return $sentencia->execute($valores);
    }
}
?>
