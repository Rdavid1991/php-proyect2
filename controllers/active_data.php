<?php
include('control_class.php');

if (array_key_exists("id", $_GET)){

    $id = $_GET["id"];

    $prod = new Update_Products();
    $prod->active_product($id);

    header('Location:/proyecto_2/views/mantenimiento.php');
}