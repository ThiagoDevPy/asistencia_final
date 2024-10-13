var tabla;

function init(){

    listar();

    $.post("../controlador/Alumno.php?op=select_empleado", function (r){
        $("#alumno_id").html(r);
        $('#alumno_id').selectpicker('refresh');
    });
}

function listar() {

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var alumno_id = $("#alumno_id").val();


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
            url: '../controlador/Asistencia.php?op=listar_asistencia',
            data: {fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, alumno_id: alumno_id },
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