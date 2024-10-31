<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registro de Asistencia</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="shortcut icon" href="../public/img/icono.ico">
  <link rel="stylesheet" href="../public/css/font-awesome.css">

  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><img src="../public/dist/img/Logos-uninorte-05-2.png" width="115" height="47" alt="" /></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Ingresa tus datos de Acceso</p>

      <form>

        <div class="form-group has-feedback">
          <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña">
          <span class="fa fa-key form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <a class="btn btn-primary" onclick="login()">Iniciar Sesion</a>
          </div>
        </div>
      </form>

    </div>

    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="../public/js/jquery-3.1.1.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="../public/js/bootstrap.min.js"></script>
  <script src="../public/js/bootbox.min.js"></script>
  <script src="scripts/validarlogin.js"></script>

</body>



</html>