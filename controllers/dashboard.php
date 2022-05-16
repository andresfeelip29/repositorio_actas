<?php

require_once 'models/actamodel.php';

class Dashboard extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('DASHBOARD::Construct -> incio de dashboard');
    }

    function render()
    {
        error_log('DASHBOARD::render -> Cargando dashboard');
        $this->view->render('dashboard/index');
    }

    function newActa()
    {
        if ($this->existPOST(['area', 'sede', 'municipio', 'departamento', 'asunto', 'fecha', 'horaInicio', 'horaFinal', 'tema'])) {
            $area = $this->getPost('area');
            $sede = $this->getPost('sede');
            $municipio = $this->getPost('municipio');
            $departamento = $this->getPost('departamento');
            $asunto = $this->getPost('asunto');
            $fecha = $this->getPost('fecha');
            $horaInicio = $this->getPost('horaInicio');
            $horaFinal = $this->getPost('horaFinal');
            $tema = $this->getPost('tema');

            $acta = new ActaModel();
            $acta->setArea($area);
            $acta->setSede($sede);
            $acta->setMunicipio($municipio);
            $acta->setDepartamento($departamento);
            $acta->setAsunto($asunto);
            $acta->setFecha($fecha);
            $acta->setHoraInicio($horaInicio);
            $acta->setHoraFinal($horaFinal);
            $acta->setTema($tema);
            if ($acta->save()) {
                $this->redirect('dashboard', ['error' => SuccessMessages::SUCCESS_ACTA_SAVE_SUCCESS]);
            } else {
                $this->redirect('dashboard', ['error' => ErrorMessages::ERROR_ACTA_NEWACTA_ERROR]);
            }
        } else {
            $this->redirect('dashboard', ['error' => ErrorMessages::ERROR_ACTA_NEWACTA_ERROR]);
        }
    }
}
