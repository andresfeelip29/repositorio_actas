<?php

class Actas extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('ACTAS::Construct -> incio de Listado de actas');
    }

    function render()
    {
        error_log('ACTAS::render -> Cargar el index de actas');
        $this->view->render('actas/index');
    }
}
