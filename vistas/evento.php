<?php
ob_start();
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'header.php';
require "../config/conexion.php";
date_default_timezone_set(ZONA_HORARIA);

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars(trim($_POST['apellidos']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
    $clave = $_POST['clave'];
}

?>

<!--CONTENIDO -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Eventos <button class="btn btn-success" onclick="mostrarform(true)" id="btnAgregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opciones</th>
                                <th>Nombre de evento</th>
                                <th>Fecha</th>
                                <th>Hora de Extension</th>
                                <th>Link del Certificado</th>
                                <th>Estado</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre de evento</th>
                                <th>Fecha</th>
                                <th>Hora de Extension</th>
                                <th>Link del Certificado</th>
                                <th>Estado</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form action="" name="formulario" id="formulario" method="POST" enctype="multipart/form-data">

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Nombre(*): </label>
                                <input class="form-control" type="hidden" name="id" id="id">
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-lg3 col-md-3 col-sm-6 col-xs-12">
                                <label>Fecha Inicio</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Hora de extension(*): </label>
                                <input class="form-control" type="text" name="horaexten" id="horaexten" maxlength="100" placeholder="Hora de extencion" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Link del Certificado(*): </label>
                                <input class="form-control" type="text" name="links" id="links" placeholder="Link del Certificado">
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php'; ?>
<script src="scripts/evento.js"></script>


<?php
ob_end_flush();
?>