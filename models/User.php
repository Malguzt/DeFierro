<?php
include 'Model.php';
/**
 * User Model.
 *
 * @author Lenscak José Francisco [Malguzt]
 */
class User extends Model {
    private $user = '';
    private $pass = '';
    private $email = '';
    private $character = '';

    /**
     * Constructor del modelo de usuario. Setea las variables con los valores pasados,
     * pero no hace ningun tipo de comprovación con ellos.
     * @param string $usuario Nombre de usuario empleado para conectarse.
     * @param string $clave Clave del usuario.
     * @param string $email Correo electronico del usuario.
     * @author Lenscak José Francisco [Malguzt]
     */
    function __construct($db, $user, $pass, $email = '') {
        $this->user = trim($user);
        $this->changePass($pass);
        $this->email = $email;
        $this->model = 'user';
        parent::__construct($db);
    }

    /**
     * Crea el registro de un nuevo usuario, validando previamente los campos de la instancia.
     * @author Lenscak José Francisco [Malguzt]
     */
    function save() {
        if($this->validateUser()) {
            return parent::save();
        }
        return False;
    }

    /**
     * Comprueva la valides del usuario. Si el usuario no es el string vacio y no existe
     * en la base de datos, entonces devuelve True, en otro caso devuelve False.
     * @return boolean
     * @author Lenscak José Francisco [Malguzt]
     */
    function validateUserName() {
        if($this->user != '') {
            $filter = array('user' => $this->user);
            $users = $this->collection->count($filter);
            if($users == 0) return true;
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
    function validateUser() {
        return ($this->validateUserName() && !empty($this->pass));
    }

    /**
     * Realiza las pruebas pertinentes sobre los datos del usuario.
     * @return string Mensaje con los errores detectados.
     */
    function buscarErrores() {
        $errores = '';
        $errores .= $this->validateUserName()? '': 'Nombre de usuario invalido.</br>';
        $errores .= empty ($this->pass)? '': 'Clave invalida.</br>';
        return $errores;
    }

    /**
     * Cambia la clave actual del objeto por una nueva.
     * @param string $claveNueva La clave que se decea introducir.
     * @param string $claveVieja La clave anterior, para comprovar que se la conoce.
     * @return Exception Si todo sale bien se devuelve a si mismo, sino devuelve una excepción.
     */
    function changePass($newPass, $oldPass = '') {
        if($this->validarClave($newPass)) {
            if(($this->pass == '') || ($this->pass == sha1($oldPass.SECURITY_STRING))) {
                $this->pass = sha1($newPass.SECURITY_STRING);
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
        $encontro = $sentencia->execute(array($this->usuario, $this->pass));
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

    function getName(){
        return $this->user;
    }

    function getPass(){
        return $this->pass;
    }
}
?>