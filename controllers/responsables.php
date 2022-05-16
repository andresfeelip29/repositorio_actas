<?php

class Responsables extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('RESPONSABLES::Construct -> incio de responsables');
    }

    function render()
    {
        error_log('RESPONSABLES::render -> Cargar el index de responsables');
        $this->view->render('responsables/index');
    }
}
