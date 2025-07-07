<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include_once '../eventos//modelo/conexion.php';

if(isset($_POST['funcion']) && $_POST['funcion']=="login_!$#"){
  try {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $usuario_info = "SELECT * FROM usuario WHERE usuario_usuario='$usuario' AND contrasena_usuario='$contrasena'";
    $result_usuario = $conn->query($usuario_info);

    if ($result_usuario->num_rows > 0) {
      // Establecer datos en la sesión
      $_SESSION['usuario'] = $usuario;
      // Establecer cookie con el ID de usuario y una caducidad de 1 día
      $expiration_time = time() + (24 * 60 * 60); // 24 horas en segundos
      setcookie('usuario', $usuario, $expiration_time, "/");

      echo json_encode(['status' => 'Ok', 'message' => 'Login Correcto']);
    } else {
      echo json_encode(['status' => 'Error', 'message' => 'Usuario/Contraseña Invalido']);
    }
  } catch (Exception $e) {
    // Registra el error en los registros del servidor
    error_log($e->getMessage());
    // Devuelve el mensaje de error al cliente
    echo json_encode(['status' => 'Error', 'message' => $e->getMessage()]);
    http_response_code(500);
  }
}

?>