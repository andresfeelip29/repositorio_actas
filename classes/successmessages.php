<?php
class SuccessMessages
{
    //el error se encripta en MD5 para que solo se muestre en la url la encriptacion
    //siguiendo la siguiente nomesclatura
    //SUCCES_CONTROLLER_METODO_ACTION

    const SUCCESS_ACTA_GUARDAR_EXISTS = "9e0a42138c23f328b9a6084fa7b8b0c8";
    const SUCCESS_ACTA_SAVE_SUCCESS = "9e0a42138c23f328b9a6084fa7b8b0c9";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            SuccessMessages::SUCCESS_ACTA_GUARDAR_EXISTS => 'Acta guardado con exito!',
            SuccessMessages::SUCCESS_ACTA_SAVE_SUCCESS => 'Acta guardado con exito!'
        ];
    }

    public function get($hash)
    {
        return $this->successList[$hash];
    }

    public function existsKey($key)
    {
        if (array_key_exists($key, $this->successList)) {
            return true;
        } else {
            return false;
        }
    }
}
