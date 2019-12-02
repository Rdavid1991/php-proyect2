<?php

require_once("../database/connect.php");

class Productos extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    function consultar_productos()
    {
        $instruccion = "CALL consultar_productos()";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }
}

class Save_Image extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    function consult_id($nombre)
    {
        $instruccion = "CALL consultar_id('" . $nombre . "')";
        $id = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($id) {
            return $id;
            $id->close();
            $this->_db->close();
        }
    }

    function save_image($nombre, $idprod)
    {
        $instruccion = "CALL guardar_imagen('" . $nombre . "','" . $idprod . "')";
        $imagen = $this->_db->query($instruccion);
        if ($imagen) {
            return $imagen;
            $imagen->close();
            $this->_db->close();
        }
    }
}

class Save_Products extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    function save_product($nombre, $descripcion, $tipo, $precio)
    {

        echo $nombre;
        $instruccion = "CALL insertar_producto('" . $nombre . "','" . $descripcion . "','" . $tipo . "','" . $precio . "')";
        $producto = $this->_db->query($instruccion);

        echo $nombre;
        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }
}
