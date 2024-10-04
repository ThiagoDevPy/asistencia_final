

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
    $("#email").val("");
    $("#login").val("");
    $("#clave").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#idusuario").val("");
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
            url: '../controlador/Usuario.php?op=listar',
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

        url: '../controlador/Usuario.php?op=guardaryeditar',
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


function mostrar(idusuario) {
    $.post("../controlador/Usuario.php?op=mostrar", { idusuario: idusuario },
        function (data, status) {
           
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombre);
            $("#apellidos").val(data.apellidos);
            $("#email").val(data.email);
            $("#login").val(data.login);
            $("#imagenmuestra").show();
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#idusuario").val(data.id);
        });
}

function desactivar(idusuario) {
    bootbox.confirm("¿Esta seguro de desactivar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Usuario.php?op=desactivar", { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}

function activar(idusuario) {
    bootbox.confirm("¿Esta seguro de activar este dato?", function (result) {
        if (result) {
            $.post("../controlador/Usuario.php?op=activar", { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                listar();
            });
        }
    })
}


init();
