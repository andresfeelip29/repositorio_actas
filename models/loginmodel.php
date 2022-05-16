<?php

require_once 'models/usermodel.php';

class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($username, $password)
    {
        try {
            $query = $this->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
            $query->bindValue('usuario', $username);
            $query->execute();
            if ($query->rowCount() == 1) {
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel();
                $user->from($item);
                $hash_password =  sha1($password);
                if ($hash_password  == $user->getContraseña()) {
                    error_log('LOGINMODEL:login->success');
                    return $user;
                } else {
                    return NULL;
                    error_log('LOGINMODEL:login->password no es igual');
                }
            }
        } catch (PDOException $e) {
            error_log('LOGINMODEL::login->Exepcion' . $e);
            return null;
        }
    }
}
