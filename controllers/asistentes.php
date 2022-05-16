<?php

class Asistentes extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('ASISTENTES::Construct -> incio de asistentes');
    }

    function render()
    {
        error_log('ASISTENTES::render -> Cargar el index asistentes');
        $this->view->render('asistentes/index');
    }
}
