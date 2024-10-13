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

require "../config/conexion.php";
date_default_timezone_set(ZONA_HORARIA);
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

          <!--box-header-->
          <div class="box-header with-border">
            <h1 class="box-title">Reportes de asistencias por fecha</h1>
            <div class="box-tools pull-right">
              
            </div>
          </div>
          <!--box-header-->

          <!--centro-->

          <!--tabla para listar datos-->
          <div class="dataTables_wrapper" id="listadoregistros">

           <div class="form-group col-lg3 col-md-3 col-sm-6 col-xs-12">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
           </div>

           <div class="form-group col-lg3 col-md-3 col-sm-6 col-xs-12">
              <label>Fecha Fin</label>
              <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
           </div> 
           <div class="form-inline col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <label>Alumno</label>
              <select name="alumno_id" id="alumno_id" class="form-control selectpicker" data-live-search="true" required>
              </select>
              <br>
              <button class="btn btn-success" onclick="listar();">
                Buscar Asistencia</button>
                </div>
           </div>
           <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tipo</th>
                
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <th>#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tipo</th>
              </tfoot>   
            </table>
        

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

<script src="scripts/rptasistencia.js"></script>


<?php
ob_end_flush();
?>
