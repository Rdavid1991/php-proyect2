<?php 
    define('assets','/proyecto_2/assets');
    define('mantenimiento','/proyecto_2/views/mantenimiento.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('assets').'/css/bootstrap.min.css'; ?>">
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.3/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="Proy 2">
  </a>

  <ul>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo constant('mantenimiento');?>">Mantenimiento</a>
    </li>
  </ul>
</nav>
    