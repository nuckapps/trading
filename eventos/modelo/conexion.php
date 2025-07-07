<?php
  // ini_set('display_errors', 1);
  // error_reporting(E_ALL);
  
  $conn = new mysqli('localhost','u135952626_jhon_trading','zuhfum-W0K-trading-db','u135952626_trading');

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }
?>