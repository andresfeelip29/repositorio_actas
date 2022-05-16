<?php


// Configuracion de erros para almacenarlos en archivos log
error_reporting(E_ALL); //error/Exepcion engine
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);
ini_set('error_log', 'php-error.log');
error_log("Inicio de la aplicacion web!");


require_once 'classes/errormessages.php';
require_once 'classes/successmessages.php';
require_once 'conexion.php';
require_once 'libs/app.php';
require_once 'libs/controller.php';
require_once 'libs/model.php';
require_once 'libs/view.php';
require_once 'classes/sessioncontroller.php';
require_once 'config/config.php';
require_once 'config/config.php';



$app = new App();

// require_once('./controllers/front_controller.php');
// $login = new main_controller();
// $login->login();
