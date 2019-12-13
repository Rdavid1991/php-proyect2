<?php
require('./main/header.php');
include("../class/lib_class.php");
$consult = array();

if(isset($_SESSION["usuario_valido"]) && $_SESSION['role'] == "admin"){

    if (array_key_exists("button", $_POST)) {
        $obj = new Report();
        if ($_POST['radio'] == "tipo") {
            $consult = $obj->consultar_tipo($_POST['inicio'], $_POST['fin']);
        } else if ($_POST['radio'] == "nombre") {
            $consult = $obj->consultar_nombre($_POST['inicio'], $_POST['fin']);
        }
    }
    
    ?>
    
    <div class="container mt-3">
    
        <div class="border rounded-pill shadow p-3">
            <form action="reporte.php" method="post" class="d-flex justify-content-around align-items-center">
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="radio" value="nombre" class="custom-control-input" required>
                    <label class="custom-control-label" for="customRadio1">Nombre</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="radio" value="tipo" class="custom-control-input" required>
                    <label class="custom-control-label" for="customRadio2">Tipo</label>
                </div>
                <div class="custom-control">
                    <input type="date" id="datepicker" name="inicio">Inico
                </div>
                <div class="custom-control ">
                    <input type="date" id="datepicker" name="fin">Fin
                </div>
                <div class="custom-control">
                    <input type="submit" class="btn btn-success" name="button" value="Filtrar">
                </div>
            </form>
        </div>
    
        <?php if ($consult && sizeof($consult) > 0) { ?>
            <div class="text-center">
                <h1 class="mt-5">Reporte por <?php echo $_POST['radio'] ?></h1>
                <h2><?php echo $_POST['inicio']." / ".$_POST['fin']?></h2>
            </div>
            <div class="d-flex justify-content-center">
                <table class="table table-striped shadow text-center">
                    <thead>
                        <tr>
                            <?php if ($_POST['radio'] == "tipo") { ?>
                                <th>Tipo</th>
                            <?php } else { ?>
                                <th>Nombre</th>
                            <?php } ?>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Precio de venta</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <?php foreach ($consult as $value) { ?>
                            <tr>
                                <th><?php echo $value['prod'] ?></th>
                                <td><?php echo $value['cantidad'] ?></td>
                                <td><?php echo number_format($value['suma'], 2, '.', '') ?><span>$</span></td>
                                <td><?php echo number_format($value['p_venta'], 2, '.', '') ?><span>$</span></td>
                                <td><?php echo $value['fecha'] ?></td>
                            </tr>
                        <?php
                                $total = +$value['suma'];
                            }
                            ?>
                        <tr>
                            <th>Total recaudado</th>
                            <td></td>
                            <th><?php echo number_format($total, 2, '.', '') ?><span>$</span></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    
    
    </div>
<?php }else {
    header("location:home.php");
} ?>
<?php require('./main/footer.php'); ?>