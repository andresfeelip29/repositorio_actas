<?php

include_once 'libs/imodel.php';

class Model
{
    function __construct()
    {
        $this->db = new Conexion();
    }

    function query($query)
    {
        return $this->db->connect()->query($query);
    }

    function prepare($query)
    {
        return $this->db->connect()->prepare($query);
    }
}
