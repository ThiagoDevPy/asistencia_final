<?php
//incluir la conexion de base de datos

require "../config/conexion.php";

class Usuario
{




    public function __construct()
    {
        
    }

    //metodo insertar usuario
    public function insertar($nombre, $apellidos, $login , $email, $clavehash, $imagen)
    {
        $sql = "INSERT INTO usuarios (nombre,apellidos,login,email,password,imagen) VALUES ('$nombre','$apellidos', '$login', '$email', '$clavehash', '$imagen')";
        return ejecutarConsulta($sql);
    }

    //METODO EDITAR USAUARIO
    public function editar($idusuario,$nombre, $apellidos, $login , $email, $clavehash, $imagen)
    {   
        if (!empty($clavehash)) {
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', login='$login', email='$email', password='$clavehash', imagen='$imagen'
            WHERE id='$idusuario'"; 
        }else {
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', login='$login', email='$email', imagen='$imagen'
            WHERE id='$idusuario'";
        }
        
        return ejecutarConsulta($sql);
    }
    

    //metodo desactivar usuario
    public function desactivar($idusuario)
    {
        $sql = "UPDATE usuarios SET estado='0' WHERE id='$idusuario'";
        return ejecutarConsulta($sql);
    }

    //metodo activar usuario
    public function activar($idusuario)
    {
        $sql = "UPDATE usuarios SET estado='1' WHERE id='$idusuario'";
        return ejecutarConsulta($sql);
    }


    	
    //metodo mostrar registros
    public function mostrar($idusuario)
    {
        $sql = "SELECT * FROM usuarios WHERE id='$idusuario'";
        return ejecutarConsultaSimplefila($sql);
    }

    //metodo listar registro
    public function listar()
    {
        $sql = "SELECT * FROM usuarios";
        return ejecutarConsulta($sql);
    }

    public function cantidad_usuario()
    {
        $sql = "SELECT count(*) nombre FROM usuarios";
        return ejecutarConsulta($sql);
    }

    public function verificar($login, $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE login='$login' AND password='$clave' AND estado='1'";
        return ejecutarConsulta($sql);
    }

    public function mostrarusu($idusuario)
    {
        $sql = "SELECT nombre FROM usuarios WHERE id='$idusuario'";
        return ejecutarConsulta($sql);
    }


}

?>