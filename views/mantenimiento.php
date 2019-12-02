<?php

require('./main/header.php');
include("../class/lib_class.php");

define('save', '/proyecto_2/controllers/save_data.php');
define('img', '/proyecto_2/upload/');
define('swiper_js','../assets');

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
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
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
    <div class="d-flex justify-content-around m-2">
        <h3>Mantenimiento</h3>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">
            Agregar Producto
        </button>
    </div>

    <div class="swiper-container">
        <div class="swiper-wrapper">

            <?php
            if ($productos) {
                foreach ($productos as $values) {
                    ?>

                    <div class="swiper-slide">
                        <div class="m-2" style="height:30rem;">

                            <img src="<?php echo constant('img') . $values['nombre_img'] ?>" style="width: 20rem;" alt="" class="img-thumbnail">

                            <div class="m-4">
                                <div class="d-flex justify-content-between">
                                    <p>Nombre: </p>
                                    <p><?php echo $values['nombre_prod'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Tipo:</p>
                                    <p><?php echo $values['tipo_prod'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Precio:</p>
                                    <p><?php echo $values['precio_prod'] ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Descripcion:</p>
                                    <p><?php echo $values['descripcion_prod'] ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary">Borrar</button>
                                <button class="btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo constant('save'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file-image" name="imagen">
                            <label class="custom-file-label" for="file-image">Seleccione un archivo</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="" placeholder="Ingrese un nombre" require>
                    </div>

                    <div class="form-group">
                        <label for="">Precio</label>
                        <input class="form-control" type="text" name="precio" id="" placeholder="Ingrese un precio" require>
                    </div>

                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="" cols="10" rows="10"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo constant('swiper_js').'/js/swiper.min.js' ?>"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: false,
        loopFillGroupWithBlank: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<?php require('./main/footer.php'); ?>