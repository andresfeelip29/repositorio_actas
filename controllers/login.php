<?php

class Login extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('Login:construct -> Incio de login');
    }

    function render()
    {
        $this->view->render('login/index');
    }

    function authenticate()
    {
        if ($this->existPOST(['usuario', 'contraseña'])) {
            error_log('LOGIN:::AUTHENTICATION ---> Autenticacion de usuario');
            $username = $this->getPost('usuario');
            $password = $this->getPost('contraseña');
            if ($username == '' || empty($username) || $password == '' || empty('password')) {
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
            }
            $user = $this->model->login($username, $password);
            if ($user != NULL) {
                error_log('LOGIN::INITIALIZE ---> USUARIOS ');
                $this->initialize($user);
            } else {
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
            }
        } else {
            $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
}
