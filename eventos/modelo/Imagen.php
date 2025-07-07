<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include_once '../../../modelo/conexion_datatable.php';

// $imagen = new Imagen();
// print_r($imagen->mostrar());

class Imagen{
  var $imagen;
  public $acceso;

  public function __construct(){
    $this->acceso = Conexion::conectar();
  }

  function nuevo( $id_producto_imagen,
                  $url_imagen,
                  $orden_imagen) {
    $sql =  "INSERT INTO imagen( id_producto_imagen,".
                                "url_imagen,".   
                                "orden_imagen)".
            "VALUES ('$id_producto_imagen', ".
                    "'$url_imagen', ".  
                    "'$orden_imagen') ";

    return $this->acceso->query($sql);         
  }

  function eliminar( $id_imagen, 
                     $id_producto_imagen) {
    $sql =  "DELETE FROM imagen WHERE id_producto_imagen='".$id_producto_imagen."' AND id_imagen='".$id_imagen."'";

    return $this->acceso->query($sql);           
  }
}
?>
