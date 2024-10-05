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
         $sql = "SELECT a.*, CONCAT(e.nombre,' ',e.apellidos) AS empleados , e.codigo FROM asistencias a INNER JOIN empleados e on a.
         empleado_id=e.id ORDER BY a.id DESC";
         return ejecutarConsulta($sql);
    }

    //metodo listar registro
    public function listar_reporte($fecha_inicio, $fecha_fin, $empleado_id)
    {
        $sql = "SELECT a.*, CONCAT(e.nombre,' ',e.apellidos) AS empleados , e.codigo FROM asistencias a INNER JOIN empleados e ON a.
        empleado_id=e.id WHERE DATE (a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.empleado_id='$empleado_id'";
        return ejecutarConsulta($sql);
    }



    public function listar_asistencia($id_evento)
    {
        $sql = "SELECT a.*, CONCAT(e.nombre,' ',e.apellidos) AS empleados , e.codigo FROM asistencias a INNER JOIN empleados e ON a.
        empleado_id=e.id WHERE a.id_evento='$id_evento'";
        return ejecutarConsulta($sql);
    }


    public function select()
    {
         $sql = "SELECT * FROM eventos";
         return ejecutarConsulta($sql);
    }
}

?>