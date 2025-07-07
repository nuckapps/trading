<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
session_start();

// Destruir la sesión
session_destroy();

// Eliminar la cookie
setcookie('usuario', '', time() - 3600, '/');

echo json_encode(['status' => 'Ok', 'message' => 'Logout Correcto']);
?>