var nombre
var precio
var countprod = 0;
var total = 0

var delete_node

var boxData

function comprar(val, id) {

    nombre = $("#producto" + id).text();
    precio = $("#precio" + id).text();

    var element = document.getElementById("cuenta");

    var div = document.createElement("div");
    div.setAttribute("class", "d-flex justify-content-around align-items-center");
    div.setAttribute("id", "cuenta_" + val.id);

    //Nodo nombre
    var nombre_hiden = document.createElement("input");
    nombre_hiden.setAttribute("name", "nombre" + countprod);
    nombre_hiden.setAttribute("type", "hidden");
    nombre_hiden.setAttribute("value", nombre);

    var node_nombre = document.createElement("h5")
    node_nombre.innerHTML = nombre
    node_nombre.setAttribute("class", "font-weight-bold shadow-sm bg-white rounded");
    div.appendChild(node_nombre);
    div.appendChild(nombre_hiden);

    //node borrar
    var node_borrar = document.createElement("div");
    node_borrar.innerHTML = '<i class="fas fa-trash"></i>'
    node_borrar.setAttribute("id", val.id);
    node_borrar.setAttribute("class", "btn btn-danger");
    node_borrar.addEventListener("click", function() {
        var element = document.getElementById("cuenta_" + this.id).parentNode;
        delete_node = document.getElementById("cuenta_" + this.id)
        total -= $("#" + id).val();

        document.getElementById("total").innerHTML = total.toFixed(2) + " $"
        element.removeChild(delete_node);
    })
    var id_hidden = document.createElement("input");
    id_hidden.setAttribute("type", "hidden");
    id_hidden.setAttribute("name", "id" + countprod);
    id_hidden.setAttribute("value", id);
    div.appendChild(node_borrar);
    div.appendChild(id_hidden);

    //Noddo precio
    var precio_hidden = document.createElement("input");
    precio_hidden.setAttribute("name", "precio" + countprod);
    precio_hidden.setAttribute("type", "hidden");
    precio_hidden.setAttribute("id", id);
    precio_hidden.setAttribute("value", precio);

    var node_precio = document.createElement("h5")
    node_precio.innerHTML = precio + "<span>$</span>";
    node_precio.setAttribute("class", "font-weight-bold shadow-sm bg-white rounded");
    div.appendChild(node_precio);
    div.appendChild(precio_hidden);

    element.appendChild(div);
    countprod += 1;
    total += parseFloat(precio);
    document.getElementById("total").innerHTML = total.toFixed(2) + "<span>$</span>"
}

function editarProducto(button) {
    boxData = button.parentNode.parentNode.childNodes[3];
    var id = boxData.parentNode.childNodes[1].childNodes[5].value

    var img = boxData.parentNode.childNodes[1].childNodes[3].value
    var nombre = boxData.childNodes[1].childNodes[3].textContent
    var tipo = boxData.childNodes[3].childNodes[3].textContent
    var precio = boxData.childNodes[5].childNodes[3].textContent
    var descripcion = boxData.childNodes[7].childNodes[3].textContent

    $('#uploadFormEdit + img').remove();
    $('#uploadFormEdit').after('<img src="' + img + '" style="width: 200px; height: 200px;">');

    $("#editNombre").val(nombre)
    $("#editTipo").val(tipo)
    $("#editPrecio").val(precio)
    $("#editDescripcion").val(descripcion)
    $("#idDelete").val(id)

}

function cleanPreview() {
    $('#uploadFormSave + img').remove();
    $('#uploadFormSave').after('<img src="/proyecto_2/assets/img/preview.png" style="width: 200px; height: 200px;">');
}

function filePreviewSave(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function(e) {
            $('#uploadFormSave + img').remove();
            $('#uploadFormSave').after('<img src="' + e.target.result + '" style="width: 200px; height: 200px;" />');
        }
    }
    input.files = null
}

function filePreviewEdit(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onload = function(e) {
            $('#uploadFormEdit + img').remove();
            $('#uploadFormEdit').after('<img src="' + e.target.result + '" style="width: 200px; height: 200px;" />');
            $('#file-image-edit').load(e.target.result);
        }
    }
    input.files = null
}

$("#file-image-save").change(function() {
    filePreviewSave(this);
});

$("#file-image-edit").change(function() {
    filePreviewEdit(this);
});