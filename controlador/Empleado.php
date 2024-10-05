<?php

//incluimos el archivo de la clase usuario
require_once "../modelos/Empleado.php";

//creamos una instancia del objeto 
$empleado = new Empleado();

//recibimo los datos enviados por el formulario html (frontend)
$empleado_id = isset($_POST["empleado_id"]) ? limpiarCadena($_POST["empleado_id"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellidos = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$documento_numero = isset($_POST["documento_numero"]) ? limpiarCadena($_POST["documento_numero"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";



//dependiendo de la operacion solicitada mediante la variable $_GET["op"]
switch ($_GET["op"]) {
    case 'guardaryeditar':



        //verificamos si se esta insertando un nuevo usuasrio o editando una existente
        if (empty($empleado_id)) {
            //si es un nuevo usuariu, llamamos al metodo insertar de la clase usuario
            $rspta = $empleado->insertar($nombre, $apellidos, $documento_numero, $telefono, $codigo);
            //Devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos registrados correctamente" : " No se pudo registrar todos los datos del usuario";
        } else {
            //si es un usuario existente, llamamos al metodo editar de la clase Usuario
            $rspta = $empleado->editar($empleado_id, $nombre, $apellidos, $documento_numero, $telefono, $codigo);
            //devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }

        break;





    case 'mostrar':
        //llamamos al metodo mostrar de la clase usuario
        $rspta = $empleado->mostrar($empleado_id);
        //devolvemos el resuktado como objeto JSON  
        echo json_encode($rspta);
        break;


    case 'listar':
        //llamamos al listar mostrar de la clase usuario
        $rspta = $empleado->listar();
        //inicializamos un array para almacenar datos
        $data = array();
        //iteramos sobre los registros obtenidos y los almacebados en el array
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellidos,
                "3" => $reg->documento_numero,
                "4" => $reg->telefono,
                "5" => $reg->carrera
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

        $rspta = $empleado->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value =' . $reg->id .'>' . $reg->nombre . ' ' . $reg->apellidos . '</option>'; //Se generan las opcioes
        }

        break;
}
