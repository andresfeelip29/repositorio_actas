<?php

require_once 'classes/session.php';
require_once 'models/usermodel.php';

class SessionController extends Controller
{
    private $userSession;
    private $userName;
    private $userId;
    private $session;
    private $sites;

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function init()
    {
        $this->session = new Session();
        $json = $this->getJSONFileConfig();

        $this->sites = $json['site'];
        $this->defaultSites = $json['default-site'];

        $this->validateSession();
    }

    public function getJSONFileConfig()
    {
        $string = file_get_contents('config/access.json');
        $json = json_decode($string, true);
        return $json;
    }

    public function validateSession()
    {
        error_log('SESSIONCONTROLLER::validateSession -> Inicio de session exitoso');
        if ($this->existsSession()) {

            $role = $this->getUserSessionData()->getRol();
            //si la pagina a entrar es publica
            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRole($role);
            } else {
                //sinoe s publica la sesion
                if ($this->isAuthorized($role)) {
                    //se deja pasar
                } else {
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        } else {
            //no existe la session
            if ($this->isPublic()) {
                //no hace nada
            } else {
                header('Location:' . constant('URL'));
            }
        }
    }

    function existsSession()
    {
        if (!$this->session->exists())   return false;
        if ($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();

        if ($userid) return true;

        return false;
    }

    function getUserSessionData()
    {
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($id);
        error_log('SESSIONCONTROLLER::getUserSessionData ->' . $this->user->getUsuario());
        return $this->user;
    }
    function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?*./", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access'] == 'public') {
                return true;
            }
        }
    }
    function getCurrentPage()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actualLink);
        error_log('SESSIONCONTROLLER::getCurrentPage ->' . $url[2]);
        return $url[2];
    }

    private function redirectDefaultSiteByRole($role)
    {
        $url = '';
        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($this->sites[$i]['role'] == $role) {
                $url = 'proyecto_final_desarrollo_web/' . $this->sites[$i]['site'];
                break;
            }
        }
        header('Location:' . constant('URL') . $url);
    }

    private function isAuthorized($rol)
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?./*", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['rol'] == $rol) {
                return true;
            }
        }
        return false;
    }

    function initialize($user)
    {
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRol());
    }

    function authorizeAccess($rol)
    {
        switch ($rol) {
            case 'Funcionario':
                $this->redirect($this->defaultSites['Funcionario'], []);
                break;
            case 'Secretaria':
                $this->redirect($this->defaultSites['Secretaria'], []);
                break;
        }
    }

    function logout()
    {
        $this->session->closeSession();
    }
}
