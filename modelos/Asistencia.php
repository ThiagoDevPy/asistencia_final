<?php
//incluir la conexion de base de datos

require "../config/conexion.php";

class Asistencia
{
   


    public function __construct()
    {
        
    }

    public function listar()
    {
         $sql = "SELECT a.*, CONCAT(e.nombre,' ',e.apellidos) AS alumnos , e.codigo FROM asistencias a INNER JOIN alumnos e on a.
         alumno_id=e.id ORDER BY a.id DESC";
         return ejecutarConsulta($sql);
    }

    //metodo listar registro
    public function listar_reporte($fecha_inicio, $fecha_fin, $alumno_id)
    {
        $sql = "SELECT a.*, CONCAT(e.nombres,' ',e.apellidos) AS alumnos , e.codigo FROM asistencias a
        INNER JOIN alumnos e ON a.alumno_id=e.id WHERE DATE (a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.id='$alumno_id'";
        return ejecutarConsulta($sql);
    }



    public function listar_asistencia($id_evento)
    {
        $sql = "SELECT a.*, CONCAT(e.nombres, ' ', e.apellidos) AS alumnos, e.*  FROM asistencias a 
        INNER JOIN alumnos e ON a.alumno_id = e.id WHERE a.id_evento = '$id_evento'";
        return ejecutarConsulta($sql);
    }


    public function select()
    {
         $sql = "SELECT * FROM eventos";
         return ejecutarConsulta($sql);
    }
}

?>