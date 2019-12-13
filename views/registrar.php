<?php
require('./main/header.php');

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $role = $_POST['radio'];

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

    if (!$nfilas > 0) {
        $obj_usuarios = new usuarios();
        $usuario_validado = $obj_usuarios->insertar_usuario($usuario, $clave_crypt, $role);
        header("Location:login.php");
    }
}
?>

<div class="container">
    <form action="registrar.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">User</label>
            <input type="text" class="form-control" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="clave" id="exampleInputPassword1">
        </div>
        <?php if (false) { ?>
            <div class="form-group">
                <p class="font-weight-bold" style="color:red">Usuario existe</p>
            </div>
        <?php } ?>
        <div class="form-group">
            <input type="radio"  value="user" name="radio">Usuario
            <input type="radio"  value="admin" name="radio">Administrador
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


<?php

require('./main/footer.php');

?>