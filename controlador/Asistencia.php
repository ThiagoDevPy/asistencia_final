<?php
    require_once "../modelos/Asistencia.php";

    //creamos una instancia del objeto 
    $asistencia = new Asistencia(); //se instancia un objeto de la clase Asistencia
    
    $empleado_id = isset($_POST["empleado_id"]) ? limpiarCadena($_POST["empleado_id"]) : ""; // se obtiene el ID del empleadp de la solicitud

    // se ejecuta un switch para determinar la acciom a realizar segun el parametro op enviado por GET 

    switch ($_GET["op"]) {

        case 'listar':
            //llamamos al listar mostrar de la clase usuario
            $rspta = $asistencia->listar();
            //inicializamos un array para almacenar datos
            $data = array();
            //iteramos sobre los registros obtenidos y los almacebados en el array
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => $reg->id,
                    "1" => $reg->empleado_id,
                    "2" => $reg->empleados,
                    "3" => $reg->fecha,
                    "4" => $reg->hora,
                    "5" => ($reg->tipo == 'Entrada') ? '<span class="label bg-green">' . $reg->tipo . '</span>' : '<span class="label 
                    bg-orange">' . $reg->tipo . '</span>'
                    
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
    
        case 'listar_asistencia':
            $fecha_inicio = $_REQUEST["fecha_inicio"];
            $fecha_fin = $_REQUEST["fecha_fin"];
            $empleado_id = $_REQUEST["empleado_id"];




            $rspta = $asistencia->listar_reporte($fecha_inicio, $fecha_fin, $empleado_id);
    
            $data = array();
            //iteramos sobre los registros obtenidos y los almacebados en el array
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(
                    "0" => $reg->id,
                    "1" => $reg->empleado_id,
                    "2" => $reg->empleados,
                    "3" => $reg->fecha,
                    "4" => $reg->hora,
                    "5" => ($reg->tipo == 'Entrada') ? '<span class="label bg-green">' . $reg->tipo . '</span>' : '<span class="label 
                    bg-orange">' . $reg->tipo . '</span>'
                    
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



            case 'listar_asistencias':
                $evento_id = $_REQUEST["id_evento"];
    
    
    
    
                $rspta = $asistencia->listar_asistencia($evento_id);
        
                $data = array();
                //iteramos sobre los registros obtenidos y los almacebados en el array
                while ($reg = $rspta->fetch_object()) {
                    $data[] = array(
                        "0" => $reg->id,
                        "1" => $reg->empleado_id,
                        "2" => $reg->empleados,
                        "3" => $reg->fecha,
                        "4" => $reg->hora,
                        "5" => ($reg->tipo == 'Entrada') ? '<span class="label bg-green">' . $reg->tipo . '</span>' : '<span class="label 
                        bg-orange">' . $reg->tipo . '</span>'
                        
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

                case 'select_evento';

                $rspta = $asistencia->select();
        
                while ($reg = $rspta->fetch_object()) {
                    echo '<option value =' . $reg->id .'>' . $reg->nombre . ' </option>'; //Se generan las opciones
                }
        
                break;
            }



       
?>