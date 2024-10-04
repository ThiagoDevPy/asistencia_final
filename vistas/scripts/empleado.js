

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
    $("#apellidos").val("");
    $("#documento_numero").val("");
    $("#telefono").val("");
    $("#codigo").val("");
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
            url: '../controlador/Empleado.php?op=listar',
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
    
    e.preventDefault();
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);


    $.ajax({

        url: '../controlador/Empleado.php?op=guardaryeditar',
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


function mostrar(empleado_id) {
    $.post("../controlador/Empleado.php?op=mostrar", { empleado_id: empleado_id },
        function (data, status) {
           
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombre);
            $("#apellidos").val(data.apellidos);
            $("#documento_numero").val(data.documento_numero);
            $("#telefono").val(data.telefono);
            $("#empleado_id").val(data.empleado_id);
            $("#codigo").val(data.codigo);
            
        });
}

function desactivar(empleado_id) {
    bootbox.confirm("¿Esta seguro de desactivar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Empleado.php?op=desactivar", { empleado_id: empleado_id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}

function activar(empleado_id) {
    bootbox.confirm("¿Esta seguro de activar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Empleado.php?op=activar", { empleado_id: empleado_id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}


init();
