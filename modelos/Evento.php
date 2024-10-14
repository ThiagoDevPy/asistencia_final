<?php
//incluir la conexion de base de datos

require "../config/conexion.php";

class Evento
{




    public function __construct()
    {
        
    }

    //metodo insertar evento
    public function insertar($nombre, $fecha)
    {
        $sql = "INSERT INTO eventos (nombre,fecha) VALUES ('$nombre', '$fecha')";
        return ejecutarConsulta($sql);
    }

    //METODO EDITAR USAUARIO
    public function editar($id,$nombre, $fecha)
    {   


            $sql = "UPDATE eventos SET nombre = '$nombre', fecha = '$fecha'
            WHERE id='$id'"; 
        
 
        
        return ejecutarConsulta($sql);
    }
    

    //metodo desactivar id_evento
    public function desactivar($id)
    {
        $sql = "UPDATE eventos SET estado='0' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }

    //metodo activar usuario
    public function activar($id)
    {
        $sql = "UPDATE eventos SET estado='1' WHERE id='$id'";
        return ejecutarConsulta($sql);
    }


    	
    //metodo mostrar registros
    public function mostrar($id)
    {
        $sql = "SELECT * FROM eventos WHERE id='$id'";
        return ejecutarConsultaSimplefila($sql);
    }

    //metodo listar registro
    public function listar()
    {
        $sql = "SELECT * FROM eventos";
        return ejecutarConsulta($sql);
    }

    public function cantidad_eventos()
    {
        $sql = "SELECT count(*) id FROM eventos";
        return ejecutarConsulta($sql);
    }

 

}

?>