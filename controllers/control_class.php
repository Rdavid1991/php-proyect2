<?php
include("../class/lib_class.php");

class Controll_Class
{
    function save($file, $post)
    {
        //save data of products
        $nombre = $post['nombre'];
        $descripcion = $post['descripcion'];
        $tipo = "combo"; //$post['tipo'];
        $precio = $post['precio'];

        $prod = new Save_Products();
        $prod->save_product($nombre, $descripcion, $tipo, $precio);

        echo $nombre;

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

        $cons_prod = new Save_Image();
        $id =  $cons_prod->consult_id($nombre);
        $id = $id[0]['id'];

        $cons_prod = new Save_Image();
        $cons_prod ->save_image($fileName, $id);

        //save file in directory with the new name
        move_uploaded_file($file['imagen']['tmp_name'], $dir . $fileName);
        header('Location:/proyecto_2/views/mantenimiento.php');
    }

    function change_name_img()
    {
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
}
