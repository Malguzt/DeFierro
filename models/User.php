<?php

require_once 'Model.php';

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
     * Constructer for the User model. Sets the variables with the values passed,
     * but does no checking.
     * @param string $user User name used to conect.
     * @param string $pass User password.
     * @param string $email User Email.
     * @author Lenscak José Francisco [Malguzt]
     */
    function __construct($db) {
        $this->model = 'user';
        parent::__construct($db);
    }

    /**
     * Save the user, previously validated the instance fields.
     * @author Lenscak José Francisco [Malguzt]
     */
    function save($data = array()) {
        $data['user'] = $this->user;
        $data['pass'] = $this->pass;
        $data['email'] = $this->email;
        if($this->hasCharacter()){
            $data['character'] = $this->character->save();
        }
        return parent::save($data);
    }

    /**
     * Check the user validity. If the user isn't the empty string and doesn't
     * exist in the datebase, then return true, otherwise it returns false.
     * @return boolean
     * @author Lenscak José Francisco [Malguzt]
     */
    function validateUserName() {
        if ($this->user != '') {
            $filter = array('user' => $this->user);
            return!$this->db->exist($filter, $this->model);
        }
        return False; //Invalid user
    }

    /**
     * Chech the validity of the password passed by parameter.
     * @param $pass Password to validate.
     * @return boolena Return the password validity.
     * @author Lenscak José Francisco [Malguzt]
     */
    function validatePass($pass) {
        if (strlen($pass) < 3 || strlen($pass) > 30) {
            return False;
        }
        return True;
    }

    /**
     * Check the validity of all user fields.
     * @return boolena
     */
    function validateUser() {
        return ($this->validateUserName() && !empty($this->pass));
    }

    /**
     * Do the relevant tests on the user's data.
     * @return string Message with the identified errors.
     */
    function findErrors() {
        $errores = '';
        $errores .= $this->validateUserName() ? '' : 'Nombre de usuario invalido.</br>';
        $errores .= empty($this->pass) ? '' : 'Clave invalida.</br>';
        return $errores;
    }

    /**
     * Change the object's current password for a new one.
     * @param string $newPass The password you want to enter.
     * @param string $oldPass The old password, to verify that it is known.
     * @return self If all goes well is returned to himself, else throws an error message.
     */
    function changePass($newPass, $oldPass = '') {
        if ($this->validatePass($newPass)) {
            if (($this->pass == '') || ($this->pass == sha1($oldPass . SECURITY_STRING))) {
                $this->setPass(sha1($newPass . SECURITY_STRING));
                return $this;
            }
            throw new Exception('La clave anterior es incorrecta');
        }
        throw new Exception('La nueva clave es invalida.');
    }

    /**
     * Load user data from the DB, using user name and password for the search.
     * @return boolean True if could load the user.
     */
    function load() {
        $filter = array(
            'user' => $this->user,
            'pass' => $this->pass
        );
        $user = $this->db->findOne($this->model, $filter);
        if (!empty($user)) {
                $this->setName($user['user']);
                $this->setPass($user['pass']);
                $this->setEmail($user['email']);
                $this->setId($user['_id']);
                return TRUE;
        }
        return false;
    }

    /**
     * Set the user's character.
     * @param Character $character
     */
    function setCharacter($character) {
        $this->character = $character;
    }

    /**
     *
     * @return string
     */
    function getName() {
        return $this->user;
    }

    /**
     *
     * @return string Password in md5.
     */
    function getPass() {
        return $this->pass;
    }

    /**
     *
     * @param string $email
     */
    function setEmail($email) {
        $this->email = $email;
    }

    function setName($name) {
        $this->user = trim($name);
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    /**
     * Return true if user has a characeter.
     * @return boolean
     */
    function hasCharacter() {
        return!empty($this->character);
    }

}

?>