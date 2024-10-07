<?php
session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se utiliza una cookie de sesión, eliminarla
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Finalmente, destruir la sesión
session_destroy();
session_unset();

// Redirigir al usuario a la página de inicio de sesión
header('Location: ../vistas/login.php'); // Cambia 'login.html' por el nombre de tu página de inicio de sesión
exit();
?>