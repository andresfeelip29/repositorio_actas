<?php
class ErrorMessages
{
    //el error se encripta en MD5 para que solo se muestre en la url la encriptacion
    //siguiendo la siguiente nomesclatura
    //ERROR_CONTROLLER_METODO_ACTION

    const ERROR_ACTA_GUARDAR_EXISTS = "b649cb5e602c55c2c6c0ed12c5b22155";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "27233ec2d551fde4fbb478b8f6be8d69";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "27233ec2d453fde4fbb478b8f6be8d69";
    const ERROR_LOGIN_AUTHENTICATE = "27233ec2d453fde4fee478b8f6be8d69";
    const ERROR_ACTA_NEWACTA_ERROR = "27233ec2d453fde4fee478b8f6be8d64";

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            ErrorMessages::ERROR_ACTA_GUARDAR_EXISTS => 'Error al guardar acta!',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Usuario o contraseña no existe!',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => 'Usuario o contraseña incorrecto!',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud!',
            ErrorMessages::ERROR_ACTA_NEWACTA_ERROR => 'No se puede guardar el acta!'
        ];
    }

    public function get($hash)
    {
        return $this->errorList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->errorList)) {
            return true;
        } else {
            return false;
        }
    }
}
