

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
    $("#correo").val("");
    $("#carrera").val("");
    $("#universidad").val("");
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
            url: '../controlador/Alumno.php?op=listar',
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

        url: '../controlador/Alumno.php?op=guardaryeditar',
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


function mostrar(alumno_id) {
    $.post("../controlador/Alumno.php?op=mostrar", { alumno_id: alumno_id },
        function (data, status) {
           
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombres);
            $("#apellidos").val(data.apellidos);
            $("#documento_numero").val(data.ci);
            $("#telefono").val(data.telefono);
            $("#alumno_id").val(data.id);
            $("#correo").val(data.correo);
            $("#carrera").val(data.carrera);
            $("#universidad").val(data.universidad);
        });
}

function desactivar(alumno_id) {
    bootbox.confirm("¿Esta seguro de desactivar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Alumno.php?op=desactivar", { alumno_id: alumno_id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}

function activar(alumno_id) {
    bootbox.confirm("¿Esta seguro de activar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Alumno.php?op=activar", { alumno_id: alumno_id }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}


init();
