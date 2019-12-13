<?php

require('./main/header.php');
include("../class/lib_class.php");

define('img', '/proyecto_2/upload/');
define('swiper_js', '../assets');
define('delete', '/proyecto_2/controllers/archive_data.php');

$consulta = new Productos();
$productos = $consulta->consultar_productos();

if (isset($_SESSION["usuario_valido"]) && $_SESSION['role'] == "admin") {
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
            width: 90%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 12px;
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto" onclick="cleanPreview()">
                Agregar Producto
            </button>

            <a class="btn btn-primary" href="archivados.php">Ver archivados</a>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">

                <?php
                    if ($productos) {
                        foreach ($productos as $values) {
                            ?>

                        <div class="swiper-slide">
                            <div class="m-2" style="height:30rem;">

                                <div class="aspect mt-4">
                                    <img src="<?php echo constant('img') . $values['imagen_prod'] ?>" alt="" id="img<?php echo $values['id'] ?>"  class="aspect-img">
                                    <input type="hidden" value="<?php echo constant('img') . $values['imagen_prod'] ?>">
                                    <input type="hidden" value="<?php echo $values['id']  ?>">
                                </div>

                                <div class="absolute-desc" style="margin-left: -3rem">
                                        <div class="mt-4" style="width: 15rem">
                                            <div class="d-flex justify-content-between">
                                                <p>Nombre: </p>
                                                <p id="nombre<?php echo $values['id']  ?>"><?php echo $values['nombre_prod'] ?></p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p>Tipo:</p>
                                                <p id="tipo<?php echo $values['id']  ?>"><?php echo $values['tipo_prod'] ?></p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p>Precio:</p>
                                                <p id="precio<?php echo $values['id']  ?>"><?php echo $values['precio_prod'] ?></p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p>Descripcion:</p>
                                                <p id="descripcion<?php echo $values['id']  ?>"><?php echo $values['descripcion_prod'] ?></p>
                                            </div>
                                            <div class="d-flex justify-content-between mt-5">
                                                <a class="btn btn-primary" href="<?php echo constant('delete') . "?id=" . $values['id']; ?>">Archivar</a>
                                                <button class="btn btn-primary" data-toggle="modal"  data-target="#modalEditar" onclick="editarProducto(<?php echo $values['id']  ?>)">Editar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        }
                    }
                    ?>
            </div>
            <!-- Add Pagination -->
            <div class=" swiper-pagination"></div>
            <!-- Add Arrows -->
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>

    <!-- include Modals -->
    <?php require("helpers/modals.php") ?>;

    <script src="<?php echo constant('swiper_js') . '/js/swiper.min.js' ?>"></script>
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
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
<?php } else {
    header("location:home.php");
} ?>


<?php require('./main/footer.php'); ?>