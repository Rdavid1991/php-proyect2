<?php
define('save', '/proyecto_2/controllers/save_data.php');
define('edit', '/proyecto_2/controllers/edit_data.php');
?>

<!-- Modal Guardar-->
<div class="modal fade" id="modalProducto" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 40rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="d-flex justify-content-between">
                <form action="<?php echo constant('save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="width: 23rem;">
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file-image-save" name="imagen" required>
                                <label class="custom-file-label" for="file-image">Seleccione un archivo</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="" placeholder="Ingrese un nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="">Precio</label>
                            <input class="form-control" type="text" name="precio" id="" placeholder="Ingrese un precio" required>
                        </div>

                        <div class="form-group">
                            <select name="categoria" class="form-control">
                                <option value="Popcorn">Popcorn</option>
                                <option value="Chocolate">Chocolate</option>
                                <option value="Soda">Soda</option>
                                <option value="Nachos">Nachos</option>
                                <option value="HotDog">HotDog</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="" cols="10" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer" style="width: 38rem">
                        <button type="button" class="btn btn-secondary" onclick="clealPreview()" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center align-items-center preview-position" style="margin-top:3rem;">
                    <div id="uploadFormSave"></div>
                    <img src="/proyecto_2/assets/img/preview.png" style="width: 200px; height: 200px;">
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal editar -->
<div class="modal fade" data-backdrop="static" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 40rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo constant('edit'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="width: 23rem;">
                    <div class="input-group ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file-image-edit" onchange="filePreview(this)" name="imagen">
                            <label class="custom-file-label" for="file-image">Seleccione un archivo</label>
                            <input type="hidden" id="idDelete" name="idDelete" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="editNombre" placeholder="Ingrese un nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="">Precio</label>
                        <input class="form-control" type="text" name="precio" id="editPrecio" placeholder="Ingrese un precio" required>
                    </div>

                    <div class="form-group">
                        <select name="categoria" id="editTipo" class="form-control">
                            <option value="Popcorn">Popcorn</option>
                            <option value="Chocolate">Chocolate</option>
                            <option value="Soda">Soda</option>
                            <option value="Nachos">Nachos</option>
                            <option value="HotDog">HotDog</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="editDescripcion" cols="10" rows="5"></textarea> <input type="hidden" name="descripcionAnterior" id="editDescripcion">
                    </div>

                </div>
                <div class="modal-footer" style="width: 38rem">
                    <button type="button" class="btn btn-secondary" onclick="clealPreview()" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
            <div class="d-flex justify-content-center align-items-center preview-position" style="margin-top:7rem;">
                <div id="uploadFormEdit"></div>
                <img src="/proyecto_2/assets/img/preview.png" id="imgOld" style="width: 200px; height: 200px;">
            </div>
        </div>
    </div>
</div>

<!-- Modal Borrar -->

<div class="modal fade" tabindex="-1" data-backdrop="static" id="modalBorrar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">¿Desea borrar permanente?</h3>
                <h4 class="text-center">El registro sera irrecuperable</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" href="<?php echo constant('delete') . "?id=" . $values['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>