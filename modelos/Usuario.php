<?php
include 'Modelo.php';
/**
 * Modelo del usuario.
 *
 * @author Lenscak José Francisco [Malguzt]
 */
class Usuario extends Modelo {
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
    function __construct($usuario, $clave, $email = '') {
        $this->usuario = trim($usuario);
        $this->cambiarClave($clave);
        $this->email = $email;
        $this->tabla = 'usuario';
    }

    /**
     * Crea el registro de un nuevo usuario, validando previamente los campos de la instancia.
     * @param PDO $conexion Objeto de conexión a la base de datos.
     * @author Lenscak José Francisco [Malguzt]
     */
    function guardar($conexion) {
        if($this->validarUsuario($conexion)) {
            $instancia = array(
                    'usuario' => $this->usuario,
                    'clave' => $this->clave,
                    'email' => $this->email
            );
            return parent::guardar($instancia, $conexion);
        }
        return False;

    }

    /**
     * Comprueva la valides del usuario. Si el usuario no es el string vacio y no existe
     * en la base de datos, entonces devuelve True, en otro caso devuelve False.
     * @param PDO $conexion Objeto de conexión a la base de datos.
     * @return boolean
     * @author Lenscak José Francisco [Malguzt]
     */
    function validarNobreDeUsuario($conexion) {
        if($this->usuario != '') {
            $sentencia = $conexion->prepare('SELECT usuario FROM usuario WHERE usuario.usuario LIKE ?');
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
     * Comprueba la valides del correo de la instancia.
     * @return boolena True si el correo es valido, False de lo contrario.
     */
    function validarCorreo() {
        //La expreción regular se extiende mucho por tener la mayoria de terminaciones posibles.
        if(($this->email == '') || ereg("^([^[:space:]]+)@(.+)\.(ad|ae|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|fi|fj|fk|fm|fo|fr|fx|ga|gb|gov|gd|ge|gf|gh|gi|gl|gm|gn|gp|gq |gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nato|nc|ne|net|biz|info|nf|ng|ni|nl|no|np|nr|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$",$this->email)) {
            return True;
        }
        return False;
    }

    /**
     * Comprueba la valides de todos los campos del usuario.
     * @param PDO $conexion Objeto de conexión a la base de datos.
     * @return boolena
     */
    function validarUsuario($conexion) {
        return ($this->validarCorreo() && $this->validarNobreDeUsuario($conexion) && !empty($this->clave));
    }

    /**
     * Realiza las pruebas pertinentes sobre los datos del usuario.
     * @param PDO $conexion
     * @return string Mensaje con los errores detectados.
     */
    function buscarErrores($conexion) {
        $errores = '';
        $errores .= $this->validarCorreo()? '': 'Dirección de correo invalida.</br>';
        $errores .= $this->validarNobreDeUsuario($conexion)? '': 'Nombre de usuario invalido.</br>';
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
     * @param PDO $conexion
     * @return boolean Verdadero si se pudo cargar el usuario.
     */
    function cargar($conexion) {
        $sentencia = $conexion->prepare('
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

    function getPJ(){
        return $this->personaje;
    }

    function getClave(){
        return $this->clave;
    }
}
?>