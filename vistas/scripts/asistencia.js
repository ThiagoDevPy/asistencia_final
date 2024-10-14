
var tabla;
//funtion que se ejecuta en el inicio
function init() {
    mostrarform(true)


    $.post("../controlador/Asistencia.php?op=select_evento", function (r){
        $("#id_evento").html(r);
        $('#id_evento').selectpicker('refresh');
    });
   

}

function mostrarform(flag) {
    if (flag) {
        $("#listadoregistros").hide();
        $("#id_evento").show();
        $("#btnlistar").show();
        $('#tbllistado').hide();
    } else {
        $("#listadoregistros").show();
        $('#tbllistado').show();
    }
}


function listar() {
    mostrarform(false)
    var id_evento = $("#id_evento").val();
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: '<"top"Blf>rt<"bottom"ip><"clear">', // Centrar botones
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
        {
            url: '../controlador/Asistencia.php?op=listar_asistencias',
            data: { id_evento: id_evento },
            type: 'get',
            datatype: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]],
       "lengthChange": false, // Oculta el control de "entries"
        "processing": false
    }).dataTable();
}

function mostrartabla(){
    $("#listadoregistros").show();
}

function ocultartabla(){
    $("#listadoregistros").hide();
}

init();