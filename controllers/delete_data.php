<?php
include('control_class.php');

if (array_key_exists("id", $_GET)){

    $id = $_GET["id"];

    $consultImg = new Productos();
    $imgDelete = $consultImg->consult_image_name($id);
    Helpers::delete_images($imgDelete[0]["imagen_prod"]);

    $prod = new Update_Products();
    $prod->delete_product($id);

    header('Location:/proyecto_2/views/archivados.php');
}