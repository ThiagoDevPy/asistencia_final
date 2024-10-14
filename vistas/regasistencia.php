<?php
ob_start();
session_start(); // Iniciar la sesión
require '../config/conexion.php';
require 'phpqrcode/qrlib.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header('Location: login.php'); // Cambia 'login.html' por el nombre de tu página de inicio de sesión
    exit(); // Asegúrate de salir del script después de redirigir

}



require 'header.php';


$new_id = uniqid();
$_SESSION['qr_id'] = $new_id;
$stmt = $conexion->prepare("INSERT INTO qr (qr_id, estado) VALUES (?, 'no utilizado')");
$stmt->bind_param("s", $new_id);
$stmt->execute();

$new_qr_code_data = "https://asis.zeabur.app/guardardatos.php?id=" . $new_id;
QRcode::png($new_qr_code_data, 'qrcodes/new_qr.png', QR_ECLEVEL_L, 10);

?>
<!--CONTENIDO -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <!-- /.col-md12 -->
            <div class="col-md-12">

                <!--fin box-->
                <div class="box">

                    <!--box-header-->
                    <div class="box-header with-border">
                        <h1 class="box-title">Registrar Asistencias </h1>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!--box-header-->

                    <!--centro-->

                    <!--tabla para listar datos-->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <h3 class="text-center">Escanear QR</h3> <!-- Cambiado a h3 y centrado -->
                            <div class="text-center"> <!-- Utilizando Bootstrap para centrar -->
                                <img id="qrCode" src="qrcodes/new_qr.png" alt="QR Code" />
                            </div>

                            <script>
                                function updateQRCode() {

                                    const currentQrId = "<?php echo $_SESSION['qr_id']; ?>"; // Obtener el ID actual
                                    console.log("ID actual:", currentQrId); // Verifica el ID
                                    $.get('updateqr.php', {
                                        id: currentQrId
                                    }, function(data) {
                                        const response = JSON.parse(data);
                                        if (response.new_qr) {
                                            const qrImage = document.getElementById('qrCode');
                                            qrImage.src = response.new_qr + '?' + new Date().getTime(); // Añadir timestamp

                                        }
                                    }).fail(function() {
                                        console.error('Error al actualizar el QR.');
                                    });
                                }

                                // Actualiza el QR cada 2 minutos (120000 ms)
                                setInterval(updateQRCode, 120000);

                            </script>



                        </div>
                        <!--fin tabla para listar datos-->

                        <!--formulatio para datos-->
                        <div class="panel-body" id="formularioregistros">



                        </div>
                        <!--fin formulatio para datos-->

                        <!--fin centro-->

                    </div>
                    <!--fin box-->

                </div>
                <!-- /.col-md12 -->

            </div>
            <!-- fin Default-box -->

    </section>
    <!-- /.content -->

</div>
<!--FIN CONTENIDO -->

<?php
require 'footer.php';
?>



<?php
ob_end_flush();
?>