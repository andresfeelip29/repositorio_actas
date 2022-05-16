<?php


class App
{
    function __construct()
    {
        require_once 'controllers/errores.php';
        //Se recibe el parametro url establecido en al config incial del .htaccess
        // si hay informacion get se asigna a url de lo contrario asigna null
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        //Se verifican los / para borras alguna si se encuetra al final de la url
        $url = rtrim($url, '/');
        //Separa cada dato que este divido por /
        $url = explode('/', $url);

        if (empty($url[0])) {
            error_log('APP:construct -> no hay controlador especificado');
            $archivo_controller = 'controllers/login.php';
            require_once $archivo_controller;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }
        $archivo_controller = 'controllers/' . $url[0] . '.php';
        //Se verifica si existe una archivo del controlador pasada por la url ingresada
        if (file_exists($archivo_controller)) {
            require_once $archivo_controller;
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    //se verifica si hay parametros para el metodo, si no hay se manda llamar el metodo
                    if (isset($url[2])) {
                        //Se verifica el numero de parametros
                        $nparam = count($url) - 2;
                        //Se almacenan en el arreglo de parametros
                        $nparam = [];
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($nparam, $url[$url + 2]);
                        }
                        $controller->{$url[1]}($nparam);
                    } else {
                        $controller->{$url[1]}();
                    }
                } else {
                    //si el metodo llamado no existe
                    //no existe el archivo, entonces se mando un error pagina 404

                    $controller = new Errores();
                    $controller->render();
                }
            } else {
                //no hay metodo a cargar, se carga uno por defecto
                $controller->render();
            }
        } else {
            //no existe el archivo, entonces se mando un error pagina 404

            $controller = new Errores();
            $controller->render();
        }
    }
}
