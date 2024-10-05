
var tabla;
//funtion que se ejecuta en el inicio
function init() {
   

    listar();
    $.post("../controlador/Asistencia.php?op=select_evento", function (r){
        $("#id_evento").html(r);
        $('#id_evento').selectpicker('refresh');
    });
 

}


function listar() {

    var id_evento = $("#id_evento").val();
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
        "order": [[0, "desc"]]
    }).dataTable();
}



init();