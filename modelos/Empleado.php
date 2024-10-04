<?php
//incluir la conexion de base de datos

require "../config/conexion.php";

class Empleado
{




    public function __construct()
    {
        
    }

    //metodo insertar usuario
    public function insertar($nombre, $apellidos, $documento_numero , $telefono, $codigo)
    {
        $sql = "INSERT INTO empleados (nombre,apellidos,documento_numero,telefono,codigo) VALUES ('$nombre','$apellidos', '$documento_numero', '$telefono', '$codigo')";
        return ejecutarConsulta($sql);
    }

    //METODO EDITAR USAUARIO
    public function editar($empleado_id,$nombre, $apellidos, $documento_numero , $telefono, $codigo)
    {   
       
        $sql = "UPDATE empleados SET nombre = '$nombre', apellidos = '$apellidos', documento_numero='$documento_numero', telefono='$telefono', codigo='$codigo'
        WHERE id='$empleado_id'"; 
        return ejecutarConsulta($sql);
    }
    
    	
    //metodo mostrar registros
    public function mostrar($empleado_id)
    {
        $sql = "SELECT * FROM empleados WHERE id='$empleado_id'";
        return ejecutarConsultaSimplefila($sql);
    }

    //metodo listar registro
    public function listar()
    {
        $sql = "SELECT * FROM empleados";
        return ejecutarConsulta($sql);
    }

   public function select()
   {
        $sql = "SELECT * FROM empleados";
        return ejecutarConsulta($sql);
   }
   public function cantidad_empleado()
   {
       $sql = "SELECT count(*) empleado_id FROM empleados";
       return ejecutarConsulta($sql);
   }
  

}

?>