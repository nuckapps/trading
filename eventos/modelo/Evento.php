<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include_once '../modelo/conexion_obj.php';

// $evento = new Evento();
// print("mostrar()");
// print_r($evento->mostrar());
// $resultado = $evento->nuevo("USD", "2024-05-05T13:16", "3", "eve", "1", "2", "../graficos/USD_2024-05-05T13:16.jpg");
// print("print: ".$resultado);

class Evento{
  var $eventos;
  public $acceso;

  public function __construct(){
    $this->acceso = Conexion::conectar();
  }

  function mostrar(){
    $sql="SELECT * FROM evento";
    $result_evento = $this->acceso->query($sql);

    // Verificar si hay resultados en la consulta de eventos
    if ($result_evento->num_rows > 0) {
      $data = array();
      while ($row_evento = $result_evento->fetch_assoc()) {
        // Consulta a la tabla imagen_kernel
        $sql_imagen_kernel = "SELECT url_imagen_kernel, orden_imagen_kernel, id_imagen_kernel FROM imagen_kernel WHERE id_evento_imagen_kernel = " . 
        $row_evento['id'] . " ORDER BY orden_imagen_kernel ASC";
        $result_imagen_kernel = $this->acceso->query($sql_imagen_kernel);

        // Crear un array con las URLs de las imágenes
        $urls_imagen_kernel = array();
        $orden_imagen_kernel = array();
        $ids_imagen_kernel = array();
        if ($result_imagen_kernel->num_rows > 0) {
          while ($row_imagen_kernel = $result_imagen_kernel->fetch_assoc()) {
            $urls_imagen_kernel[] = $row_imagen_kernel['url_imagen_kernel'];
            $orden_imagen_kernel[] = $row_imagen_kernel['orden_imagen_kernel'];
            $ids_imagen_kernel[] = $row_imagen_kernel['id_imagen_kernel'];
          }
        }

        // Agregar el array de URLs al registro de evento
        $row_evento['id_imagen_kernel'] = $urls_imagen_kernel;
        $row_evento['orden_imagen_kernel'] = $orden_imagen_kernel;
        $row_evento['primary_imagen_kernel'] = $ids_imagen_kernel;

        $data[] = $row_evento;
      }
      $this->eventos = $data;
    }



    // $this->eventos = $result_evento->fetch_all(MYSQLI_ASSOC);
    return $this->eventos;
  }

  function nuevo( $divisa,
                  $fecha_hora,
                  $volatilidad ,
                  $evento,
                  $puntos,
                  $actual,
                  $anterior,
                  $grafico) {
    $sql =  "INSERT INTO evento( divisa,".
                                  "fecha_hora,". 
                                  "volatilidad,".   
                                  "evento,".   
                                  "puntos,".
                                  "actual,".   
                                  "anterior,".   
                                  "grafico) ". 
            "VALUES ('$divisa', ".
                    "'$fecha_hora', ".    
                    "'$volatilidad', ".  
                    "'$evento', ".  
                    "'$puntos', ".  
                    "'$actual', ".  
                    "'$anterior', ".  
                    "'$grafico') ";

    return $this->acceso->query($sql); 
    // return "DUMB";              
  }
}
?>
