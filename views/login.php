<?php

require('./main/header.php');

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $salt = substr($usuario, 0, 2);
    $clave_crypt = crypt($clave, $salt);

    require_once("../class/usuarios.php");

    $obj_usuarios = new usuarios();
    $usuario_validado = $obj_usuarios->validar_usuario($usuario, $clave_crypt);

    foreach ($usuario_validado as $array_resp) {
        foreach ($array_resp as $value) {
            $nfilas = $value;
        }
    }

    if ($nfilas > 0) {
        $usuario_valido = $usuario;

        $obj_usuarios = new usuarios();
        $user = $obj_usuarios->verificar_usuario($usuario);

        $_SESSION["role"] =$user[0]['role'];
        $_SESSION["id"] =$user[0]['id'];
        $_SESSION["usuario_valido"] = $usuario_valido;
    }
}
?>


<BODY>
    <?php
    // Sesion iniciada 
    if (isset($_SESSION["usuario_valido"])) {

        header("location:home.php");

    } else if (isset($usuario)) { ?>

        <p>Acceso no autorizado</p>

    <?php } else { ?>
        <div class="container">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">User</label>
                    <input type="text" class="form-control" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="clave" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    <?php }

    require('./main/footer.php');
    ?>