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

    function consultar_productos_archivados()
    {
        $instruccion = "CALL consultar_productos_archivados()";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }

    function consult_image_name($id)
    {
        $instruccion = "CALL consult_image_name('" . $id . "')";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }
}

class Save_Products extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    function save_product($nombre, $imagen, $descripcion, $tipo, $precio)
    {
        $instruccion = "CALL insertar_producto('" . $nombre . "','" .  $imagen .   "','" . $descripcion . "','" . $tipo . "','" . $precio . "')";
        $producto = $this->_db->query($instruccion);

        echo $nombre;
        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }

    function save_product_acount($id, $precio,$iduser)
    {
        $instruccion = "CALL save_sales('" . $id . "','" . $precio . "','" . $iduser . "')";
        $producto = $this->_db->query($instruccion);

        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }
}

class Update_Products extends coneccion
{
    public function __construct()
    {
        parent::__construct();
    }

    function update_product($id, $nombre, $imagen, $descripcion, $tipo, $precio)
    {
        $instruccion = "CALL update_producto('" . $id . "','" . $nombre . "','" .  $imagen .   "','" . $descripcion . "','" . $tipo . "','" . $precio . "')";
        $producto = $this->_db->query($instruccion);

        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }

    function delete_product($id)
    {
        $instruccion = "CALL delete_producto('" . $id . "')";
        $producto = $this->_db->query($instruccion);

        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }

    function archive_product($id)
    {
        $instruccion = "CALL archive_product('" . $id . "')";
        $producto = $this->_db->query($instruccion);

        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }

    function active_product($id)
    {
        $instruccion = "CALL active_product('" . $id . "')";
        $producto = $this->_db->query($instruccion);

        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }
}

class Report extends coneccion{
    public function __construct()
    {
        parent::__construct();
    }

    function consultar_tipo($inicio,$fin)
    {
        $instruccion = "CALL consultar_tipo('".$inicio."','".$fin."')";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }

    function consultar_nombre($inicio,$fin)
    {
        $instruccion = "CALL consultar_nombre('".$inicio."','".$fin."')";
        $productos = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($productos) {
            $this->_db->close();
            return $productos;
        }
    }
}