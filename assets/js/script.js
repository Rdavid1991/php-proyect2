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

    var tbody = document.createElement("tbody");
    tbody.setAttribute("id", "cuenta_" + val.id);

    var tr = document.createElement("tr")
    var td = document.createElement("td");
    //Nodo nombre
    var nombre_hiden = document.createElement("input");
    nombre_hiden.setAttribute("name", "nombre" + countprod);
    nombre_hiden.setAttribute("type", "hidden");
    nombre_hiden.setAttribute("value", nombre);

    var node_nombre = document.createElement("h5")
    node_nombre.innerHTML = nombre
    node_nombre.setAttribute("class", "font-weight-bold shadow-sm bg-white rounded");

    td.appendChild(node_nombre);
    td.appendChild(nombre_hiden);
    tr.appendChild(td);
    tbody.appendChild(tr);

    td = document.createElement("td")
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

    td.appendChild(node_borrar);
    td.appendChild(id_hidden);
    tr.appendChild(td);
    tbody.appendChild(tr);

    td = document.createElement("td")
        //Noddo precio
    var precio_hidden = document.createElement("input");
    precio_hidden.setAttribute("name", "precio" + countprod);
    precio_hidden.setAttribute("type", "hidden");
    precio_hidden.setAttribute("id", id);
    precio_hidden.setAttribute("value", precio);

    var node_precio = document.createElement("h5")
    node_precio.innerHTML = precio + "<span>$</span>";
    node_precio.setAttribute("class", "font-weight-bold shadow-sm bg-white rounded");

    td.appendChild(node_precio);
    td.appendChild(precio_hidden);
    tr.appendChild(td);
    tbody.appendChild(tr);

    element.appendChild(tbody);
    countprod += 1;
    total += parseFloat(precio);
    document.getElementById("total").innerHTML = total.toFixed(2) + "<span>$</span>"
}

var img

function editarProducto(button) {

    var id = button
    img = $("#img" + button)[0].src
    var nombre = $("#nombre" + button)[0].innerText
    var tipo = $("#tipo" + button)[0].innerText
    var precio = $("#precio" + button)[0].innerText
    var descripcion = $("#descripcion" + button)[0].innerText

    $('#uploadFormEdit + img').remove();
    $('#uploadFormEdit').after('<img src="' + img + '" style="width: 200px; height: 200px;">');
    $("#editNombre").val(nombre)
    $("#editTipo").val(tipo)
    $("#editPrecio").val(precio)
    $("#editDescripcion").val(descripcion)
    $("#idDelete").val(id)
    $("#file-image-edit").val(toString(img))
}

function cleanPreview() {
    $('#uploadFormSave + img').remove();
    $('#uploadFormSave').after('<img src="/proyecto_2/assets/img/preview.png" style="width: 200px; height: 200px;">');
}

var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;

function filePreviewSave(input) {

    if (!allowedExtensions.exec($(input).val())) {

        alert('Archivos permitidos .jpeg/.jpg/.png/.gif only.');
        $(input).val('')
        return false;
    } else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $('#uploadFormSave + img').remove();
                $('#uploadFormSave').after('<img src="' + e.target.result + '" style="width: 200px; height: 200px;" />');
            }
        }
    }
}

function filePreviewEdit(input) {

    if (!allowedExtensions.exec($(input).val())) {

        alert('Archivos permitidos .jpeg/.jpg/.png/.gif .');
        $(input).val('')
        return false;
    } else {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $('#uploadFormEdit + img').remove();
                $('#uploadFormEdit').after('<img src="' + e.target.result + '" style="width: 200px; height: 200px;" />');
                $('#file-image-edit').load(e.target.result);
            }
        }
    }
}

$("#file-image-save").change(function() {
    filePreviewSave(this);
});

$("#file-image-edit").change(function() {
    filePreviewEdit(this);
});

function clealPreview() {
    $("#file-image-edit").val('')
}