<?php
/**
 * Clase generica con las caracteristicas comunes a todos los modelo.
 *
 * @author Lenscak José Francisco
 */
abstract class Modelo {
    protected $tabla;
    protected $conexion;

    public function __construct($conexion){
        $this->setConexion($conexion);
    }

    function setConexion($conexion){
        $this->conexion = $conexion;
    }

    function getConexion(){
        return $this->conexion;
    }

    protected function guardar($arreglo) {
        $valores = array();
        $campos = '';
        /** @internal Variable para almacenar la cantidad de signos de interrogación necesaria. */
        $signos = '';
        $separador = '';
        foreach ($arreglo as $campo => $valor) {
            $campos .= $separador.$campo;
            $signos .= $separador.'?';
            $separador = ', ';

            array_push($valores, $valor);
        }
        $sentencia = $this->getConexion()->prepare("INSERT INTO $this->tabla ($campos) VALUES ($signos)");
        return $sentencia->execute($valores);
    }
}
?>