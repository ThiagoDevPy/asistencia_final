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
            <h1 class="box-title">Listas de Alumnos <button class="btn btn-success" onclick="mostrarform(true)" id="btnAgregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
            <div class="box-tools pull-right">
              
            </div>
          </div>
          <!--box-header-->

          <!--centro-->

          <!--tabla para listar datos-->
          <div class="panel-body table-responsive" id="listadoregistros">

            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Documento</th>
                <th>Telefono</th>
                <th>Carrera</th>
                
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <th>Opciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Documento</th>
                <th>Telefono</th>
                <th>Carrera</th>
              </tfoot>   
            </table>

          </div>
          <!--fin tabla para listar datos-->

          <!--formulatio para datos-->
          <div class="panel-body" id="formularioregistros">

            <form action="" name="formulario" id="formulario" method="POST">
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Nombre(*): </label>
                <input class="form-control" type="hidden" name="empleado_id" id="empleado_id">
                <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Apellidos(*): </label>
                <input class="form-control" type="text" name="apellidos" id="apellidos" maxlength="100" placeholder="Apellidos" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Numero de Documento(*): </label>
                <input class="form-control" type="text" name="documento_numero" id="documento_numero" maxlength="70" placeholder="Email" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Telefono(*): </label>
                <input class="form-control" type="text" name="telefono" id="telefono" maxlength="70" placeholder="Nombre de usuario" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Codigo(*): </label>
                <input class="form-control" type="text" name="codigo" id="codigo" maxlength="70" placeholder="Clave" >
              </div>
             

              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              </div>
            </form>

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

<script src="scripts/empleado.js"></script>

<?php 
ob_end_flush();
?>