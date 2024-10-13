<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Asistencias</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
  <link rel="shortcut icon" href="../public/img/icono.ico">

  <!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
  <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>U</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"> <img src="../public/dist/img/Logos-uninorte-05-1.png" width="115" height="47" alt="" /><b></b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Admin</span>
                
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
               
                <!-- Menu Footer-->
                <li class="user-header">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="../controlador/logout.php" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

      


          <li><a href="escritorio.php"><i class="fa  fa-dashboard (alias)"></i> <span>Escritorio</span></a>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-list"></i> <span>Asistencias</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="asistencia.php"><i class="fa fa-circle-o"></i> Asistencias</a></li>
              <li><a href="rptasistencia.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
              <li><a href="regasistencia.php"><i class="fa fa-circle-o"></i> Registrar Asistencias</a></li>
            </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-lock"></i> <span>Eventos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="evento.php"><i class="fa fa-circle-o"></i>Eventos</a></li>
              
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>Alumnos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="alumno.php"><i class="fa fa-circle-o"></i> Lista de Alumnos</a></li>
             
            </ul>
          </li>



          
         

          <li class="treeview">
            <a href="#">
              <i class="fa fa-lock"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
              
            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>