<?php
define('assets_css', '/proyecto_2/assets');
define('mantenimiento', '/proyecto_2/views/mantenimiento.php');
define('reporte', '/proyecto_2/views/reporte.php');
define('login', '/proyecto_2/views/login.php');
define('registrar', '/proyecto_2/views/registrar.php');
define('logout', '/proyecto_2/views/logout.php');
define('home', '/proyecto_2/views/home.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?php echo constant('assets_css') . '/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo constant('assets_css') . '/css/swiper.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo constant('assets_css') . '/css/style.css'; ?>">
  <link rel="stylesheet" href="<?php echo constant('assets_css') . '/css/all.min.css'; ?>">
  <title>Document</title>
</head>

<body>

  <nav class="navbar  navbar-light bg-light">
    <div class="row" style="width: 100%">
      <div class="col-2">
        <a class="navbar-brand" href="<?php echo constant('home'); ?>">
          <img src="/docs/4.3/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="Proy 2">
        </a>
      </div>

      <div class="col-5">
        <div class="float-left">
          <div class="d-flex justify-content-between">
            <?php if (isset($_SESSION["usuario_valido"]) && $_SESSION['role'] == "admin") { ?>

              <a class="nav-link" href="<?php echo constant('mantenimiento'); ?>">Mantenimiento</a>


              <a class="nav-link" href="<?php echo constant('reporte'); ?>">Reporte</a>

            <?php } ?>
          </div>
        </div>
      </div>

      <div class="col-5">
        <div class="float-right">
          <div class="d-flex justify-content-between">
            <?php if (isset($_SESSION["usuario_valido"])) { ?>

              <a class="nav-link" href="<?php echo constant('logout'); ?>">logout</a>

            <?php } else { ?>

              <a class="nav-link" href="<?php echo constant('login'); ?>">Login</a>

              <a class="nav-link" href="<?php echo constant('registrar'); ?>">Registrar</a>

            <?php } ?>
          </div>

        </div>
      </div>
    </div>






  </nav>