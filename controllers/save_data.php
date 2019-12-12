<?php
include('control_class.php');

if (is_uploaded_file($_FILES['imagen']['tmp_name']) && array_key_exists('nombre', $_POST)) {
    $data = new Save_Class();
    $data->save($_FILES,$_POST);
    
}

header('Location:/proyecto_2/views/mantenimiento.php');
