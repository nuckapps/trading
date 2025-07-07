<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include_once '../modelo/conexion_obj.php';

// $imagen = new Imagen();
// print_r($imagen->mostrar());

class ImagenKernel{
  var $imagen_kernel;
  public $acceso;

  public function __construct(){
    $this->acceso = Conexion::conectar();
  }

  function nuevo( $id_evento_imagen,
                  $url_imagen,
                  $orden_imagen) {
    $sql =  "INSERT INTO imagen_kernel( id_evento_imagen,".
                                        "url_imagen,".   
                                        "orden_imagen)".
            "VALUES ('$id_producto_imagen', ".
                    "'$url_imagen', ".  
                    "'$orden_imagen') ";

    return $this->acceso->query($sql);         
  }

  function eliminar( $id_imagen, 
                     $id_evento_imagen) {
    $sql =  "DELETE FROM imagen_kernel WHERE id_evento_imagen='".$id_producto_imagen."' AND id_imagen='".$id_imagen."'";

    return $this->acceso->query($sql);           
  }
}
?>
