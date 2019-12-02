var nombre
var precio
var countprod = 0;
var total = 0

var delete_node

function comprar(val) {

    nombre = val.childNodes[1].childNodes[3].childNodes[1].childNodes[1];
    precio = val.childNodes[1].childNodes[3].childNodes[1].childNodes[3];

    var element = document.getElementById("cuenta");

    var div = document.createElement("div");
    div.setAttribute("class", "d-flex justify-content-around");
    div.setAttribute("id", "cuenta_" + val.id);

    //Nodo nombre
    var node_nombre = document.createElement("input");
    node_nombre.setAttribute("name", "nombre" + countprod);
    node_nombre.setAttribute("type", "text");
    node_nombre.setAttribute("value", nombre.textContent);
    node_nombre.setAttribute("class", "input_class font-weight-bold shadow-sm bg-white rounded");
    div.appendChild(node_nombre);

    var node_borrar = document.createElement("div");
    node_borrar.setAttribute("id", val.id);
    node_borrar.setAttribute("class", "btn btn-danger");
    node_borrar.addEventListener("click", function () {
        var element = document.getElementById("cuenta_" + this.id).parentNode;
        delete_node = document.getElementById("cuenta_" + this.id)
        total -= delete_node.childNodes[2].value;
        document.getElementById("total").innerHTML = total.toFixed(2) + " $"

        element.removeChild(delete_node);
    })
    div.appendChild(node_borrar);

    //Noddo precio
    var node_precio = document.createElement("input");
    node_precio.setAttribute("name", "precio" + countprod);
    node_precio.setAttribute("type", "text");
    node_precio.setAttribute("value", precio.textContent);
    node_precio.setAttribute("class", "input_class font-weight-bold shadow-sm bg-white rounded");
    div.appendChild(node_precio)
    element.appendChild(div);

    countprod += 1;

    total += parseFloat(precio.textContent);
    document.getElementById("total").innerHTML = total.toFixed(2)

    console.log(nombre)
}
