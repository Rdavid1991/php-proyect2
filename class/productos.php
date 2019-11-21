<?php

include("../database/connect.php");

class Productos extends credencialesDB{
    public function __construct(){
        parent::__construct();
    }

    function consultar_productos(){
        $instruccion = "CALL consultar_productos()";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }
}