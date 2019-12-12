<?php

require("./main/header.php");

include("../class/lib_class.php");

define('index_img', '/proyecto_2/upload/');
define('swiper_index_js', '../assets');

$consulta = new Productos();
$productos = $consulta->consultar_productos()
?>

<style>
    html,
    body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .swiper-container {
        width: 100%;
        height: 36rem;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        text-align: center;
        font-size: 14px;
        background: #fff;
        height: calc((100% - 30px) / 2);
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
</style>

<div class="container-fluid">

    <div class="row">

        <div class="col-9 mt-2">
            <div class="swiper-container mt-2">
                <div class="swiper-wrapper">
                    <?php
                    if ($productos) {
                        $code = 0;
                        foreach ($productos as $values) {?>
                            <div class="swiper-slide  border_rounded" id="box<?php echo $code ?>" onclick="comprar(this, <?php echo $values['id'] ?>)">
                                <div class="m-1" style="height:100%;">

                                    <img src="<?php echo constant('index_img') . $values['imagen_prod'] ?>" style="width: 15rem; height:10rem" alt="" class="img-thumbnail m-2">

                                    <div class="mx-5">
                                        <div class="d-flex justify-content-between">
                                            <p id="producto<?php echo $values['id'] ?>"><?php echo $values['nombre_prod'] ?></p>
                                            <p id="precio<?php echo $values['id'] ?>"><?php echo $values['precio_prod'] ?></p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p><?php echo $values['descripcion_prod'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php  $code += 1;
                        }
                    } ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <!--<div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
            </div>
        </div>

        <div class="col-3 mt-2 text-center">
            <h4 class="text-center">Cuenta</h4>
            <form action="cuenta.php" id="cuenta" method="post">
                <div class="input-group d-flex justify-content-between">
                    <input type="submit" class="btn btn-success" value="Confirmar">
                    <label class="font-weight-bold">Total</label>
                    <label class="font-weight-bold" id="total">0.00 $</label>
                </div>
                <div class="d-flex justify-content-around mt-3">
                    <h4 class="font-weight-bold">Producto</h4>
                    <h4 class="font-weight-bold">Precio</h4>
                </div>
            </form>
        </div>

    </div>


</div>

<script src="<?php echo constant('swiper_index_js') . '/js/swiper.min.js' ?>"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        slidesPerColumn: 2,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'progressbar'
        },
    });
</script>


<?php require('./main/footer.php'); ?>