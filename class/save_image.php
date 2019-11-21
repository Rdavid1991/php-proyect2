<?php

include("../database/connect.php");

class Save_Data extends credencialesDB
{
    public function __construct(){
        parent::__construct();
    }

    function save($file, $post){
        //save data of products
        $nombre = $post['nombre'];
        $descripcion = $post['descripcion'];
        $tipo = "combo";//$post['tipo'];
        $precio = $post['precio'];
        $this->save_product($nombre, $descripcion, $tipo, $precio);

        //create directory if doesn't existe
        $dir = '../upload/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        //extract only the extension from name file
        $info = new SplFileInfo($file['imagen']['name']);
        $fileExt =  $info->getExtension();

        //generate new name for the file
        $fileName = $this->change_name_img() . '.' . $fileExt;

        $id = $this->consult_id($nombre);
        $id = $id[0]['id'];

        

        $algo = $this->save_data_image($fileName , $id);
        print_r($algo);

        //save file in directory with the new name
        move_uploaded_file($file['imagen']['tmp_name'], $dir . $fileName);
        header('Location:/proyecto_2/views/mantenimiento.php');
    }

    function change_name_img(){
        $arr_str = str_split("abcdefghijklmnopqrstuvwxyz123456789");
        $new_name = '';

        for ($i = 0; $i < 8; $i++) {
            $new_name = $new_name . $arr_str[rand(0, sizeof($arr_str) - 1)];
        }

        if (is_file('../upload/' . $new_name)) {
            $this->change_name_img();
        }
        return $new_name;
    }

    function save_product($nombre, $descripcion, $tipo, $precio){

        $instruccion = "CALL insertar_producto('" . $nombre . "','" . $descripcion . "','" . $tipo . "','" . $precio . "')";
        $producto = $this->_db->query($instruccion);
        if ($producto) {
            return $producto;
            $producto->close();
            $this->_db->close();
        }
    }

    function consult_id($nombre ){
        $instruccion = "CALL consultar_id('" . $nombre . "')";
        $id = $this->_db->query($instruccion)->fetch_all(MYSQLI_ASSOC);
        if ($id) {
            $this->_db->close();
            return $id;
        }
    }

    function save_data_image($nombre,$idprod){
        parent::__construct();
        $instruccion = "CALL guardar_imagen('" . $nombre . "','" . $idprod . "')";
        $imagen = $this->_db->query($instruccion);
        print($imagen);

        if ($imagen) {
            return $imagen;
            $imagen->close();
            $this->_db->close();
        }
    }
}
