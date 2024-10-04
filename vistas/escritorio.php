<?php

ob_start();

session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header('Location: login.php'); // Cambia 'login.html' por el nombre de tu página de inicio de sesión
    exit(); // Asegúrate de salir del script después de redirigir

}
require 'header.php';
require_once('../modelos/Empleado.php');
$empleado = new Empleado();
$rspta = $empleado->cantidad_empleado();
$reg = $rspta->fetch_object();
$reg->empleado_id;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars(trim($_POST['apellidos']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
    $clave = $_POST['clave'];

    // Verificar el token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token CSRF no válido.");
    }

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array(mime_content_type($_FILES['imagen']['tmp_name']), $allowed_types)) {
            die("Tipo de archivo no permitido.");
        }
        // Procesar la imagen
    }

    // Aquí puedes proceder a guardar los datos en la base de datos
}

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
                    <div class="panel-body">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-green">
                                <a href="asistencia.php" class="small-box-footer">
                                    <div class="inner">
                                        <h5 class="font-size: 20px;">
                                            <strong>Lista asistencias</strong>
                                        </h5>
                                        <p>Modulo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>&nbsp;
                                    <div class="small-box-footer">
                                        <i class="fa"></i>
                                    </div>

                                </a>
                            </div>
                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-orange">

                                <div class="inner">
                                    <h4 class="font-size: 20px;">
                                        <strong>Alumnos</strong>
                                    </h4>
                                    <p>Total <?php echo $reg->empleado_id; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <a href="empleado.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-green">
                                <a href="rptasistencia.php" class="small-box-footer">
                                    <div class="inner">
                                        <h5 class="font-size: 20px;">
                                            <strong>Reporte de asistencias</strong>
                                        </h5>
                                        <p>Modulo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </div>&nbsp;
                                    <div class="small-box-footer">
                                        <i class="fa"></i>
                                    </div>

                                </a>
                            </div>
                        </div>







                        <!--box-header-->

                        <!--centro-->

                        <!--tabla para listar datos-->

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

<script src="scripts/asistencia.js"></script>

<?php
ob_end_flush();
?>