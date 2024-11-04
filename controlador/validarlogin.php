<?php
ob_start();
session_start(); // Iniciar la sesión
require "../config/conexion.php"; // Asegúrate de que este archivo esté correctamente configurado
// Obtener y sanitizar datos POST
$usuario = filter_var(trim($_POST['usuario']));
$contrasena = trim($_POST['contrasena']);

// Preparar respuesta
$response = ['success' => false, 'message' => 'Nombre de usuario o contraseña incorrectos.'];

if ($usuario && $contrasena) {
    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare("SELECT id, password FROM usuarios WHERE login = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Verificar si el usuario existe y si la contraseña es correcta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['password'])) {
            // Contraseña correcta
            $_SESSION['user_id'] = $row['id'];
            session_regenerate_id(true); 
            $response = ['success' => true, 'message' => 'Inicio de sesión exitoso.'];
        }
    }

    $stmt->close();
}

$conexion->close();

// Enviar respuesta JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
