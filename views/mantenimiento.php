<?php 

require('./main/header.php'); 

define('save','/proyecto_2/controllers/save_data.php');

?>

<div class="container-fluid">
    <div class="d-flex justify-content-between m-5">
        <h1>Mantenimiento</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">
            Agregar Producto
        </button>
    </div>


    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-9">

        </div>
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

            <form action="<?php echo constant('save');?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-group ">
                        <div class="custom-file" >
                            <input type="file" class="custom-file-input" id="file-image" name="imagen" >
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

<?php require('./main/footer.php');

?>