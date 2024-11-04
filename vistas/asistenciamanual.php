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
                    <div class="box-header with-border text-center">
                        <h1 class="box-title">Registrar Manualmente</h1>
                        <div class="box-tools pull-right">

                        </div>
                    </div>
                    <!--box-header-->

                    <!--centro-->

                    <!--tabla para listar datos-->
                    <div class="dataTables_wrapper text-center" style="display: flex; justify-content: center;">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label>Seleccione un Evento</label>
                            <select name="id_evento" id="id_evento" class="form-control selectpicker" data-live-search="true" required>
                            </select>


                        </div>


                    </div>



                    <div class="dataTables_wrapper text-center" style="display: flex; justify-content: center; margin: 20px;">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Numero de cedula(*) </label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Numero de Cedula" required>
                            </div>


                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">Buscar</button>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="datos">

                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Nombres</label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Numero de Cedula" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Telefono</label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Telefono" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Email</label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Email" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Carrera</label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Carrera" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-6 col-xs-12">
                                <label for="">Universidad</label>

                                <input class="form-control" type="number" name="nombre" id="nombre" placeholder="Universidad" required>
                            </div>


                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">Registrar Asistencia</button>
                            </div>


                        </div>


                        </div>
                        <!-- Button trigger modal -->
                        




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
<script src="scripts/asistenciamanual.js"></script>


<?php
ob_end_flush();
?>