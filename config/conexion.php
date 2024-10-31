<?php
//incluye el archivo global.php
require "global.php";


    //hacemos conexion con la base de datos
    $conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, PORT);

    //establece el conjunto de caracteress para la conexion
    mysqli_query($conexion, 'SET NAMES "' .DB_ENCODE. '"');

  
    //Comprueba si hay errores de conexion
    if (mysqli_connect_errno()) {
        print("Fallo la conexion con la base de datos> %s\n".mysqli_connect_errno());
        exit();
    }

    //verifica si la funcion ejecutarConsulta no esta definida para evitar conflictos de redefinicion
    if (!function_exists('ejecutarConsulta')) {
        //define la funcion ejectarConsulta que ejecuta consultas SQL y devuelve el resultado
        function ejecutarConsulta($sql){
            global $conexion;
            //ejecuta la consulta sql y devuelve el resultado
            $query = $conexion->query($sql);
            return $query;
           
        }


        function ejecutarConsulta1($sql){
            global $conexion;
            //ejecuta la consulta sql y devuelve el resultado
            $query = $conexion->query($sql);
            return $query;
            
        }
    

        
    //define la funcion ejectarConsulta que ejecuta consultas SQL y devuelve una fila de resultados
    function ejecutarConsultaSimplefila($sql){
        global $conexion;
    //ejecuta la consulta sql y devuelve una fila de resultados
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }


    //define la funcion ejecutarConsulta retonarID que ejecuta consultas SQL y devuelve el ID insertado
    function ejecutarConsulta_retornarID($sql){
        global $conexion;
        //ejecuta la consulta sql y devuelve el id insertado
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $conexion->insert_id;
    }


    //define la funcion limpiar cadena para evitar las inyecciones sql
    function limpiarCadena($str) {
        global $conexion;
    // Escapa la cadena para la base de datos
        $str = mysqli_real_escape_string($conexion, trim($str));
    
    // Escapa la cadena para HTML
         return htmlspecialchars($str);
    }
}
?>