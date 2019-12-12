<?php
require('./main/header.php');
include("../class/lib_class.php");
$consult = array();

if (array_key_exists("button", $_POST)) {
    $obj = new Report();
    if ($_POST['radio'] == "tipo") {
        $consult = $obj->consultar_tipo($_POST['inicio'], $_POST['fin']);
    } else if ($_POST['radio'] == "nombre") {
        $consult = $obj->consultar_nombre($_POST['inicio'], $_POST['fin']);
    }
}

?>

<div class="container mt-5">

    <div class="">
        <form action="reporte.php" method="post" class="d-flex justify-content-around">
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="radio" value="nombre" class="custom-control-input" required>
                <label class="custom-control-label" for="customRadio1">Nombre</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="radio" value="tipo" class="custom-control-input" required>
                <label class="custom-control-label" for="customRadio2">Tipo</label>
            </div>
            <div class="form-group d-flex align-items-center">
                <input type="date" id="datepicker" name="inicio">
                <p>Inico</p>
            </div>
            <div class="form-group d-flex align-items-center">
                <input type="date" id="datepicker" name="fin">
                <p>Fin</p>
            </div>
            <div class="form-group d-flex align-items-center">
                <input type="submit" name="button" value="Filtrar">
            </div>
        </form>
    </div>

    <?php if (sizeof($consult) > 0) { ?>
        <div class="text-center">
            <h1 class="m-5">Reporte por <?php echo $_POST['radio'] ?></h1>
        </div>
        <div class="d-flex justify-content-center">
            <table>
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
                            <td><?php echo $value['prod'] ?></td>
                            <td><?php echo $value['cantidad'] ?></td>
                            <td><?php echo $value['suma'] ?></td>
                            <td><?php echo $value['p_venta'] ?></td>
                            <td><?php echo $value['fecha'] ?></td>
                        </tr>
                    <?php
                            $total = +$value['suma'];
                        }
                        ?>
                    <tr>
                        <td>Total recaudado</td>
                        <td></td>
                        <td><?php echo $total ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>


</div>

<?php require('./main/footer.php'); ?>