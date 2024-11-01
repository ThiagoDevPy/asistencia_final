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
require_once '../modelos/Alumno.php';
$alumno = new Alumno();
$rspta = $alumno->cantidad_alumnos();
$reg = $rspta->fetch_object();
$reg->id;



?>



<!--CONTENIDO -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- Default box -->
            <div class="row">

                <!-- /.col-md12 -->
                <div class="col-md-12">

                    <!--fin box-->

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
                                    <p>Total <?php echo $reg->id; ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>

                                <a href="alumno.php" class="small-box-footer">Agregar <i class="fa fa-arrow-circle-right"></i></a>

                            </div>
                        </div>




                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-blue">
                                <a href="regasistencia.php" class="small-box-footer">
                                    <div class="inner">
                                        <h5 class="font-size: 20px;">
                                            <strong>Registrar de asistencias</strong>
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


                    <!-- /.col-md12 -->

                </div>
                <!-- fin Default-box -->
            </div>




            <div class="row">

                <!-- /.col-md12 -->
                <div class="col-md-12">

                    <!--fin box-->

                    <div class="panel-body">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-red">
                                <a href="usuario.php" class="small-box-footer">
                                    <div class="inner">
                                        <h5 class="font-size: 20px;">
                                            <strong>Usuarios</strong>
                                        </h5>
                                        <p>Modulo</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>&nbsp;
                                    <div class="small-box-footer">
                                        <i class="fa"></i>
                                    </div>

                                </a>
                            </div>
                        </div>



                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="small-box bg-yellow">
                                <a href="evento.php" class="small-box-footer">
                                    <div class="inner">
                                        <h5 class="font-size: 20px;">
                                            <strong>Eventos</strong>
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


                    <!-- /.col-md12 -->

                </div>
                <!-- fin Default-box -->
            </div>


        </div>


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