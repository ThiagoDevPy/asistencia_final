<?php
ob_start();
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit();
}

// Conectar a la base de datos
include '../config/conexion.php'; // Asegúrate de que este archivo esté correctamente configurado

// Obtener el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Consultar la base de datos para obtener la información del usuario
$stmt = $conexion->prepare("SELECT nombre FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los datos del usuario
$user = $result->fetch_assoc();

// Cerrar la consulta y la conexión
$stmt->close();
$conexion->close();

// Enviar la respuesta en formato JSON
header('Content-Type: application/json');
if ($user) {
    echo json_encode(['success' => true, 'username' => $user['nombre']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
}
ob_end_flush();
?>