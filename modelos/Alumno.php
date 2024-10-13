<?php
//incluir la conexion de base de datos

require "../config/conexion.php";

class Alumno
{




    public function __construct()
    {
        
    }

    //metodo insertar usuario
    public function insertar($nombre, $apellidos, $documento_numero , $telefono,$carrera, $correo, $universidad)
    {
        $sql = "INSERT INTO alumnos (nombres,apellidos,ci,telefono, carrera, correo, universidad) VALUES ('$nombre','$apellidos', '$documento_numero', '$telefono',  '$carrera', '$correo', '$universidad')";
        return ejecutarConsulta($sql);
    }

    //METODO EDITAR USAUARIO
    public function editar($alumno_id,$nombre, $apellidos, $documento_numero , $telefono, $carrera, $correo, $universidad)
    {   
       
        $sql = "UPDATE alumnos SET nombres = '$nombre', apellidos = '$apellidos', ci='$documento_numero', telefono='$telefono', carrera = '$carrera', correo = '$correo', universidad = '$universidad'
        WHERE id='$alumno_id'"; 
        return ejecutarConsulta($sql);
    }
    
    	
    //metodo mostrar registros
    public function mostrar($alumno_id)
    {
        $sql = "SELECT * FROM alumnos WHERE id='$alumno_id'";
        return ejecutarConsultaSimplefila($sql);
    }

    //metodo listar registro
    public function listar()
    {
        $sql = "SELECT * FROM alumnos";
        return ejecutarConsulta($sql);
    }

   public function select()
   {
        $sql = "SELECT * FROM alumnos";
        return ejecutarConsulta($sql);
   }
   public function cantidad_empleado()
   {
       $sql = "SELECT count(*) id FROM alumnos";
       return ejecutarConsulta($sql);
   }
  

}

?>