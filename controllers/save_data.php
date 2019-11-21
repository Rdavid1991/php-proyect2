<?php
include("../class/save_image.php");

if (is_uploaded_file($_FILES['imagen']['tmp_name']) && array_key_exists('nombre', $_POST)) {
    $img = new Save_Data();
    $img->save($_FILES,$_POST);
}
