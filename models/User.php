<?php
include 'Model.php';
/**
 * Modelo del usuario.
 *
 * @author Lenscak José Francisco [Malguzt]
 */
class User extends Model {
    private $usuario = '';
    private $clave = '';
    private $email = '';
    private $personaje = '';

    /**
     * Constructor del modelo de usuario. Setea las variables con los valores pasados,
     * pero no hace ningun tipo de comprovación con ellos.
     * @param string $usuario Nombre de usuario empleado para conectarse.
     * @param string $clave Clave del usuario.
     * @param string $email Correo electronico del usuario.
     * @author Lenscak José Francisco [Malguzt]
     */
    function __construct($conexion, $usuario, $clave, $email = '') {
        $this->usuario = trim($usuario);
        $this->cambiarClave($clave);
        $this->email = $email;
        $this->tabla = 'usuario';
        parent::__construct($conexion);
    }

    /**
     * Crea el registro de un nuevo usuario, validando previamente los campos de la instancia.
     * @author Lenscak José Francisco [Malguzt]
     */
    function guardar() {
        if($this->validarUsuario()) {
            $instancia = array(
                    'usuario' => $this->usuario,
                    'clave' => $this->clave,
                    'email' => $this->email
            );
            return parent::guardar($instancia, $this->getConexion());
        }
        return False;

    }

    /**
     * Comprueva la valides del usuario. Si el usuario no es el string vacio y no existe
     * en la base de datos, entonces devuelve True, en otro caso devuelve False.
     * @return boolean
     * @author Lenscak José Francisco [Malguzt]
     */
    function validarNobreDeUsuario() {
        if($this->usuario != '') {
            $sentencia = $this->getConexion()->prepare('SELECT usuario FROM usuario WHERE usuario.usuario LIKE ?');
            $sentencia->execute(array($this->usuario));
            $usuario = $sentencia->fetch();
            if(empty($usuario)) {
                return True; //El usuario es valido.
            }
        }
        return False; //Usuario invalido.
    }

    /**
     * Comprueba la valides de la clave pasada por parametro.
     * @param $clave Clave a evaluar.
     * @return boolena Devuelve la valides o no de la clave.
     * @author Lenscak José Francisco [Malguzt]
     */
    function validarClave($clave) {
        if(strlen($clave) < 3 || strlen($clave) > 30) {
            return False;
        }
        return True;
    }

    /**
     * Comprueba la valides de todos los campos del usuario.
     * @return boolena
     */
    function validarUsuario() {
        return ($this->validarCorreo() && $this->validarNobreDeUsuario($this->getConexion()) && !empty($this->clave));
    }

    /**
     * Realiza las pruebas pertinentes sobre los datos del usuario.
     * @return string Mensaje con los errores detectados.
     */
    function buscarErrores() {
        $errores = '';
        $errores .= $this->validarNobreDeUsuario($this->getConexion())? '': 'Nombre de usuario invalido.</br>';
        $errores .= empty ($this->clave)? '': 'Clave invalida.</br>';
        return $errores;
    }

    /**
     * Cambia la clave actual del objeto por una nueva.
     * @param string $claveNueva La clave que se decea introducir.
     * @param string $claveVieja La clave anterior, para comprovar que se la conoce.
     * @return Exception Si todo sale bien se devuelve a si mismo, sino devuelve una excepción.
     */
    function cambiarClave($claveNueva, $claveVieja = '') {
        if($this->validarClave($claveNueva)) {
            if(($this->clave == '') || ($this->clave == sha1($claveVieja.CADENA_DE_SEGURIDAD))) {
                $this->clave = sha1($claveNueva.CADENA_DE_SEGURIDAD);
                return $this;
            }
            return 'La clave anterior es incorrecta.';
        }
        return 'La nueva clave es invalida.';
    }

    /**
     * Carga los datos del usuario desde la DB, tiene en cuenta el nombre de usuario
     * y la clave.
     * @return boolean Verdadero si se pudo cargar el usuario.
     */
    function cargar() {
        $sentencia = $this->getConexion()->prepare('
            SELECT usuario, clave, id_personaje
            FROM usuario u
            WHERE u.usuario = ?
            AND u.clave = ?');
        $encontro = $sentencia->execute(array($this->usuario, $this->clave));
        $usuario = $sentencia->fetch();
        if(empty($usuario)){
            return false;
        } else {
            $this->definirPJ($usuario['id_personaje']);
            return true;
        }
    }

    /**
     * Define el personaje con el que esta jugando el Usuario
     * @param Personaje $personaje 
     */
    function definirPJ($personaje){
        $this->personaje = $personaje;
    }

    function getNombre(){
        return $this->usuario;
    }

    function getClave(){
        return $this->clave;
    }
}
?>