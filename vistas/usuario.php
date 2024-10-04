<?php
ob_start();
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'header.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
    $apellidos = htmlspecialchars(trim($_POST['apellidos']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
    $clave = $_POST['clave'];
    
    // Verificar el token CSRF
 
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
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Listas de usuarios <button class="btn btn-success" onclick="mostrarform(true)" id="btnAgregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
          </div>
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Login</th>
                <th>Email</th>
                <th>Imagen</th>
                <th>Estado</th>
              </thead>
              <tbody></tbody>
              <tfoot>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Login</th>
                <th>Email</th>
                <th>Imagen</th>
                <th>Estado</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form action="" name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
              
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Nombre(*): </label>
                <input class="form-control" type="hidden" name="idusuario" id="idusuario">
                <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Apellidos(*): </label>
                <input class="form-control" type="text" name="apellidos" id="apellidos" maxlength="100" placeholder="Apellidos" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Email(*): </label>
                <input class="form-control" type="text" name="email" id="email" maxlength="70" placeholder="Email" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Login(*): </label>
                <input class="form-control" type="text" name="login" id="login" maxlength="70" placeholder="Nombre de usuario" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Clave de ingreso(*): </label>
                <input class="form-control" type="password" name="clave" id="clave" maxlength="70" placeholder="Clave">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-xs-12">
                <label for="">Imagen(*): </label>
                <input class="form-control filestyle" data-buttonTetxt="Seleccionar foto" type="file" name="imagen" id="imagen" maxlength="70">
                <input type="hidden" name="imagenactual" id="imagenactual">
                <img src="" alt="" width="150px" height="120" id="imagenmuestra">
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
<script src="scripts/usuario.js"></script>


<?php
ob_end_flush();
?>