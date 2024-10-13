<?php

//incluimos el archivo de la clase usuario
require_once "../modelos/Alumno.php";

//creamos una instancia del objeto 
$alumno = new Alumno();

//recibimo los datos enviados por el formulario html (frontend)
$alumno_id = isset($_POST["alumno_id"]) ? limpiarCadena($_POST["alumno_id"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellidos = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$documento_numero = isset($_POST["documento_numero"]) ? limpiarCadena($_POST["documento_numero"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena($_POST["correo"]) : "";
$carrera = isset($_POST["carrera"]) ? limpiarCadena($_POST["carrera"]) : "";
$universidad = isset($_POST["universidad"]) ? limpiarCadena($_POST["universidad"]) : "";


//dependiendo de la operacion solicitada mediante la variable $_GET["op"]
switch ($_GET["op"]) {
    case 'guardaryeditar':



        //verificamos si se esta insertando un nuevo usuasrio o editando una existente
        if (empty($alumno_id)) {
            //si es un nuevo usuariu, llamamos al metodo insertar de la clase usuario
            $rspta = $alumno->insertar($nombre, $apellidos, $documento_numero, $telefono, $carrera, $correo, $universidad);
            //Devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos registrados correctamente" : " No se pudo registrar todos los datos del usuario";
        } else {
            //si es un usuario existente, llamamos al metodo editar de la clase Usuario
            $rspta = $alumno->editar($alumno_id, $nombre, $apellidos, $documento_numero, $telefono, $carrera, $correo,$universidad);
            //devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }

        break;





    case 'mostrar':
        //llamamos al metodo mostrar de la clase usuario
        $rspta = $alumno->mostrar($alumno_id);
        //devolvemos el resuktado como objeto JSON  
        echo json_encode($rspta);
        break;


    case 'listar':
        //llamamos al listar mostrar de la clase usuario
        $rspta = $alumno->listar();
        //inicializamos un array para almacenar datos
        $data = array();
        //iteramos sobre los registros obtenidos y los almacebados en el array
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->nombres,
                "2" => $reg->apellidos,
                "3" => $reg->ci,
                "4" => $reg->telefono,
                "5" => $reg->carrera,
                "6" => $reg->correo,
                "7" => $reg->universidad
            );
        }


        //preparanos la respuesta para datatabkes

        $results = array(
            "sEcho" => 1, //informacion para databales
            "iTotalRecords" => count($data), //enviamoos eñ tptañ de registrados a datatables
            "iTotalDisplayRecords" => count($data), //total de registro a mostrar en datatables
            "aaData" => $data //datos de los empleados
        );

        echo json_encode($results);

        break;

        case 'select_empleado':

        $rspta = $alumno->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value =' . $reg->id .'>' . $reg->nombres . ' ' . $reg->apellidos . '</option>'; //Se generan las opcioes
        }

        break;
}
