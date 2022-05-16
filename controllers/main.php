<?php

require_once './libs/controller.php';

class Main extends Controller
{
    function __construct()
    {
        parent::__construct();
        echo "<p> Controlador principal</p>";
    }
    function saludo()
    {
        echo "Metodo saludo";
    }
}
