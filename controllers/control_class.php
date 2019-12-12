<?php
include("../class/lib_class.php");
include("../helpers/helpers.php");

class Save_Class
{
    function save($file, $post)
    {
        //save data of products
        $nombre = $post['nombre'];
        $descripcion = $post['descripcion'];
        $tipo = "combo"; //$post['tipo'];
        $precio = $post['precio'];

        //create directory if doesn't existe
        $dir = '../upload/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        //extract only the extension from name file
        $info = new SplFileInfo($file['imagen']['name']);
        $fileExt =  $info->getExtension();

        //generate new name for the file
        $fileName = Helpers::change_name_img() . '.' . $fileExt;

        $prod = new Save_Products();
        $prod->save_product($nombre, $fileName, $descripcion, $tipo, $precio);

        //save file in directory with the new name
        move_uploaded_file($file['imagen']['tmp_name'], $dir . $fileName);
    }
}

class Edit_Class
{
    function edit($file, $post)
    {
        //save data of products
        $nombre = $post['nombre'];
        $descripcion = $post['descripcion'];
        $tipo = "combo"; //$post['tipo'];
        $precio = $post['precio'];
        $id = $post['idDelete'];

        $consultImg = new Productos();
        $imgDelete = $consultImg->consult_image_name($id);
        Helpers::delete_images($imgDelete[0]["imagen_prod"]);

        //extract only the extension from name file
        $info = new SplFileInfo($file['imagen']['name']);
        $fileExt =  $info->getExtension();

        //generate new name for the file
        $fileName = Helpers::change_name_img() . '.' . $fileExt;

        $prod = new Update_Products();
        $prod->update_product($id, $nombre, $fileName, $descripcion, $tipo, $precio);

        $dir = '../upload/';

        //save file in directory with the new name
        move_uploaded_file($file['imagen']['tmp_name'],  $dir . $fileName);
        header('Location:/proyecto_2/views/mantenimiento.php');
    }
}

class Acount_Class
{
    function save($post)
    {

        $array = array();

        foreach ($_POST as $value) {
            array_push($array, $value);
        }

        for ($i = 0; $i < sizeof($array); $i++) {
            if ($i % 2 == 0) {
                $prod = new Save_Products();
                $prod->save_product_acount($array[$i], $array[$i + 1]);
            }
        }
    }
}
