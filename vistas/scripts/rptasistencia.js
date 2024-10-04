var tabla;

function init(){

    listar();

    $.post("../controlador/Empleado.php?op=select_empleado", function (r){
        $("#empleado_id").html(r);
        $('#empleado_id').selectpicker('refresh');
    });
}

function listar() {

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var empleado_id = $("#empleado_id").val();


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
            data: {fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, empleado_id: empleado_id },
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