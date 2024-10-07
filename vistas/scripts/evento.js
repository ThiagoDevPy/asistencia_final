

//funtion que se ejecuta en el inicio
function init() {
    mostrarform(false);

    listar();
    
    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    })

}

function limpiar() {
    $("#nombre").val("");
    $("#fecha").val("");
    $("#id").val("");
}

function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnAgregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
    }
}


function cancelarform() {
    limpiar();
    mostrarform(false);
}


function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
        {
            url: '../controlador/Evento.php?op=listar',
            type: 'get',
            datatype: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    }).dataTable();
}


function guardaryeditar(e) {
    var fecha = $("#fecha").val();
    var id = $("#id").val();
    var nombre = $("#nombre").val();
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    console.log(formData);
    formData.append("fecha", fecha);
    formData.append("id", id);
    formData.append("nombre", nombre);

    $.ajax({

        url: '../controlador/Evento.php?op=guardaryeditar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarform(false);
            listar();
        }
    });
    limpiar();




}


function mostrar(id) {
    $.post("../controlador/Evento.php?op=mostrar", { id: id },
        function (data, status) {
           
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombre);
            $("#id").val(data.id);
            $("#fecha").val(data.fecha);
           var fecha = $("#fecha").val();
           console.log(fecha);
        });
}

function desactivar(id) {
    bootbox.confirm("¿Esta seguro de desactivar este evento?", function (result) {
        if (result) {
            $.post("../controlador/Evento.php?op=desactivar", { id: id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}

function activar(id) {
    bootbox.confirm("¿Esta seguro de activar este evento?", function (result) {
        if (result) {
            $.post("../controlador/Evento.php?op=activar", { id: id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}


init();
