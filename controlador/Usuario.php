<?php
//iniciamos sesion
session_start();
//incluimos el archivo de la clase usuario
require_once "../modelos/Usuario.php";

//creamos una instancia del objeto 
$usuario = new Usuario();

//recibimo los datos enviados por el formulario html (frontend)
$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellidos = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$login = isset($_POST["login"]) ? limpiarCadena($_POST["login"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$password = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";


//dependiendo de la operacion solicitada mediante la variable $_GET["op"]
switch ($_GET["op"]) {
    case 'guardaryeditar':
        //inicializamos la variable que contendra el hash de la contraseña 
        $clavehash = '';

        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
                $imagen = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
            }
        }

        //si se ha ingresado una nueva contraseña
        if (!empty($password)) {
            //generamos eñ hash SHA256 PARA la contraseña   
            $clavehash = password_hash($password, PASSWORD_DEFAULT);
        }

        //verificamos si se esta insertando un nuevo usuasrio o editando una existente
        if (empty($idusuario)) {
            //si es un nuevo usuariu, llamamos al metodo insertar de la clase usuario
            $rspta = $usuario->insertar($nombre, $apellidos, $login, $email, $clavehash, $imagen);
            //Devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos registrados correctamente" : " No se pudo registrar todos los datos del usuario";
        } else {
            //si es un usuario existente, llamamos al metodo editar de la clase Usuario
            $rspta = $usuario->editar($idusuario, $nombre, $apellidos, $login, $email, $clavehash, $imagen);
            //devolvemos un mensaje segun el resultado de la operacion
            echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }

        break;


    case 'desactivar':
        //llamamos al metodo desactivar de la clase usuario
        $rspta = $usuario->desactivar($idusuario);
        //devolvemos un mensaje segun el resultado de la operacion
        echo $rspta ? "Datos desactivados coorectamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        //llamamos al metodo activar de la clase usuario
        $rspta = $usuario->activar($idusuario);
        //devolvemos un mensaje segun el resultado de la operacion
        echo $rspta ? "Datos activados coorectamente" : "No se pudo activar los datos";
        break;


    case 'mostrar':
        //llamamos al metodo mostrar de la clase usuario
        $rspta = $usuario->mostrar($idusuario);
        //devolvemos el resuktado como objeto JSON  
        echo json_encode($rspta);
        break;


    case 'listar':
        //llamamos al listar mostrar de la clase usuario
        $rspta = $usuario->listar();
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
                "2" => $reg->apellidos,
                "3" => $reg->login,
                "4" => $reg->email,
                "5" => "<img src= '../files/usuarios/" . $reg->imagen . "' height ='50px' width='50px'>",
                "6" => ($reg->estado) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'

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


    case 'verificar':

            // Validamos si el usuario tiene acceso al sistema
            $logina = $_POST['logina'];
            $clavea = $_POST['clavea'];
        
            // Hash SHA256 para la contraseña
            $clavehash = hash('SHA256', $clavea);
        
            // Verificar las credenciales
            $rspta = $usuario->verificar($logina, $clavehash);
            $fetch = $rspta->fetch_object();

            
        
            if (isset($fetch)) {
                // Si se encontró el usuario, guardar los datos en la sesión
                $_SESSION['idusuario'] = $fetch->idusuario;
                $_SESSION['nombre'] = $fetch->nombre;
                $_SESSION['imagen'] = $fetch->imagen;
                $_SESSION['login'] = $fetch->login;
        
                // Devolver una respuesta exitosa
            }
            
            echo json_encode($fetch);
        
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
