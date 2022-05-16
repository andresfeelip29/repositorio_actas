<?php

class Errores extends Controller
{
    function __construct()
    {
        parent::__construct();
        error_log('Errores:construct -> Incio de errores');
    }

    function render()
    {
        error_log('Errores:render -> Incio de errores');
        $this->view->render('errores/index');
    }
}
