<?php
ob_start();
session_start(); // Iniciar la sesión
require '../config/conexion.php';
require 'phpqrcode/qrlib.php';
include_once '../config/qrconfig.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Cambia 'login.html' por el nombre de tu página de inicio de sesión
    exit();
}

// Header
require 'header.php';




if (!isset($_SESSION['qr_id'])) {
    $new_id = uniqid();
    $_SESSION['qr_id'] = $new_id;

    // Usar una declaración preparada para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO qr (qr_id, estado) VALUES (?, 'no utilizado')");
    $stmt->bind_param("s", $new_id);
    if (!$stmt->execute()) {
        die("Error al insertar el código QR: " . $stmt->error);
    }
    global $base_url;
    $new_qr_code_data = $base_url."/controlador/guardardatos.php?id=" . $new_id;
    QRcode::png($new_qr_code_data, 'qrcodes/new_qr.png', QR_ECLEVEL_L, 10);
}
?>
<!-- CONTENIDO -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Registrar Asistencias</h1>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <h3 class="text-center">Escanear QR</h3>
                        <div class="text-center">
                            <img id="qrCode" src="qrcodes/new_qr.png" alt="QR Code" />
                        </div>
                        <div id="timer" class="text-center mt-3"></div> <!-- Contenedor para el temporizador -->

                        <script>
                            let timerDuration = 119; // 2 minutos en segundos
                            let timer; // Variable para almacenar el intervalo del temporizador

                            // Función para mostrar y reiniciar el temporizador
                            function startTimer(duration) {
                                let timerDisplay = document.getElementById('timer');
                                let timerValue = duration;

                                timer = setInterval(function() {
                                    let minutes = parseInt(timerValue / 60, 10);
                                    let seconds = parseInt(timerValue % 60, 10);

                                    minutes = minutes < 10 ? "0" + minutes : minutes;
                                    seconds = seconds < 10 ? "0" + seconds : seconds;

                                    timerDisplay.textContent = "El QR expira en: " + minutes + ":" + seconds;

                                    if (--timerValue < 0) {
                                        clearInterval(timer);
                                        updateQRCode();
                                        timerDisplay.textContent = "El QR ha expirado.";
                                        // Reiniciar el temporizador
                                        setTimeout(function() {
                                            startTimer(duration); // Reiniciar el temporizador
                                        }, 1000); // Espera 3 segundos antes de reiniciar
                                    }
                                }, 1000);
                            }

                            // Función para actualizar el QR
                            function updateQRCode() {
                                const currentQrId = "<?php echo $_SESSION['qr_id']; ?>"; // Asegúrate de que esta variable está correctamente definida
                                console.log("ID actual:", currentQrId);
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

                            // Iniciar el temporizador al cargar la página
                            window.onload = function() {
                                startTimer(timerDuration);
                            };
                        </script>
                    </div>
                    <div class="panel-body" id="formularioregistros"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'footer.php';
ob_end_flush();
?>