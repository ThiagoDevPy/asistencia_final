<?php
//iniciamos sesion
session_start();
//incluimos el archivo de la clase usuario
require_once "../modelos/Evento.php";

//creamos una instancia del objeto 
$evento = new Evento();

//recibimo los datos enviados por el formulario html (frontend)
$id_evento = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]) : "";
$horaexten = isset($_POST["horaexten"]) ? limpiarCadena($_POST["horaexten"]) : "";
$links = isset($_POST["links"]) ? limpiarCadena($_POST["links"]) : "";


//dependiendo de la operacion solicitada mediante la variable $_GET["op"]
switch ($_GET["op"]) {
    case 'guardaryeditar':
    
        if (!empty($fecha)) {
            $dateTime = DateTime::createFromFormat('Y-m-d', $fecha);
            if ($dateTime) {
                $fechaFormateada = $dateTime->format('Y-m-d');
            } else {
                echo "Fecha no válida.";
                exit; // Salir si la fecha no es válida
            }
        } else {
            echo "La fecha está vacía.";
            exit; // Salir si la fecha está vacía
        }
        //verificamos si se esta insertando un nuevo usuasrio o editando una existente
        if (empty($id_evento)) {
            //si es un nuevo usuariu, llamamos al metodo insertar de la clase usuario
            $rspta = $evento->insertar($nombre, $fecha, $horaexten,$links );
            //Devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos registrados correctamente" : " No se pudo registrar todos los datos del usuario";
        } else {
            //si es un usuario existente, llamamos al metodo editar de la clase Usuario
            $rspta = $evento->editar($id_evento, $nombre, $fecha,$horaexten, $links);
            //devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }

        break;


    case 'desactivar':
        //llamamos al metodo desactivar de la clase usuario
        $rspta = $evento->desactivar($id_evento);
        //devolvemos un mensaje segun el resultado de la operacion
        echo $rspta ? "Datos desactivados coorectamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        //llamamos al metodo activar de la clase usuario
        $rspta = $evento->activar($id_evento);
        //devolvemos un mensaje segun el resultado de la operacion
        echo $rspta ? "Datos activados coorectamente" : "No se pudo activar los datos";
        break;


    case 'mostrar':
        //llamamos al metodo mostrar de la clase usuario
        $rspta = $evento->mostrar($id_evento);
        //devolvemos el resuktado como objeto JSON  
        echo json_encode($rspta);
        break;


    case 'listar':
        //llamamos al listar mostrar de la clase usuario
        $rspta = $evento->listar();
        //inicializamos un array para almacenar datos
        $data = array();
        //iteramos sobre los registros obtenidos y los almacebados en el array
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->estado) ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . ' ' .
                    '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->id . ')"><i class ="fa fa-close"></i></button>' : '<button class="btn btn-warning 
                btn-xs" onclick="mostrar(' . $reg->id . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-primary btn-xs" onclick="activar(' .
                        $reg->id . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->fecha,
                "3" => $reg->horaexten,
                "4" => $reg->links,
                "5" => ($reg->estado) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'

            );
        }


        //preparanos la respuesta para datatabkes

        $results = array(
            "sEcho" => 1, //informacion para databales
            "iTotalRecords" => count($data), //enviamoos eñ tptañ de registrados a datatables
            "aaData" => $data
        );

        echo json_encode($results);

        break;

   


    case 'salir':
        //limpiamos las variables de la sesion
        session_unset();
        //destruimos la sesion
        session_destroy();
        //redireccionamo al login
        header("location: ../index.php");
        break;
}
