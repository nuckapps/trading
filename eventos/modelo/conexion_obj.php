<?php
  class Conexion{
    public static function conectar() {
      $conexion = new mysqli('localhost','u135952626_jhon_trading','zuhfum-W0K-trading-db','u135952626_trading');
      // Verificar si la conexión fue exitosa
      if ($conexion->connect_error) {
        // Imprimir mensaje de error y terminar la ejecución
        echo "Error de conexión: " . $conexion->connect_error;
        die();
      } else {
        // Establecer la codificación UTF8
        $conexion->set_charset('utf8');

        // Imprimir mensaje de conexión exitosa
        // echo "Conexión a la base de datos establecida correctamente";

        // Devolver la conexión
        return $conexion;
      }
    }
  }
?>
