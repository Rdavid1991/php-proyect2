<?php
include('control_class.php');

$data = new Acount_Class();
$data->save($_POST);

header('Location:/proyecto_2/views/home.php');
