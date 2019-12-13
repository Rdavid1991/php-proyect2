<?php
define('save', '/proyecto_2/controllers/save_acount.php');


//print_r($_POST);
$array = array();
$total = 0;

foreach ($_POST as $value) {
    array_push($array, $value);
}

require('./main/header.php');

if (isset($_SESSION["usuario_valido"])) {

?>
<div class="d-flex justify-content-center mt-3">
    <div class="card" style="width: 30rem">
        <h5 class="card-header text-center">Cuenta</h5>
        <div class="card-body">
            <h5 class="card-title text-center">Lista de productos comprados</h5>
            <div class="d-flex justify-content-center">
                <form action="<?php echo constant('save'); ?>" method="POST">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-left"> Producto</th>
                                <th class="text-right">Precio</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php for ($i = 1; $i < sizeof($array); $i = $i + 3) { ?>
                                <tr>
                                    <td class="text-left">
                                        <?php print($array[$i - 1]); ?>
                                        <input type="hidden" name="id<?php echo $i ?>" value="<?php print($array[$i]); ?>">
                                    </td>
                                    <td class="text-right">
                                        <?php print($array[$i + 1]); ?>
                                        <input type="hidden" name="precio<?php echo $i ?>" value="<?php print($array[$i + 1]); ?>"><span>$</span>
                                    </td>
                                </tr>
                            <?php
                                $total = number_format($total + floatval($array[$i + 1]), 2, '.', '');
                            }
                            ?>
                             <tr>
                                 <th>Total a pagar</th>
                                 <th><?php echo $total ?><span>$</span></th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-around">
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require('./main/footer.php'); 
}else{
    header("location:login.php");
}?>