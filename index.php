<?php 


// Manejar otras rutas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

if ($uri === 'login') {
    include 'vistas/login.php';
} elseif ($uri === 'escritorio') {
    include 'vistas/escritorio.php';
} elseif ($uri === '') {
    include 'vistas/escritorio.php';
} 

else {
    // Maneja el error o redirige a la vista predeterminada
    include 'vistas/404.php'; // Asegúrate de tener una vista 404
}