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

  function nuevo( $id_evento_imagen_kernel,
                  $url_imagen_kernel,
                  $orden_imagen_kernel) {
    $sql =  "INSERT INTO imagen_kernel( id_evento_imagen_kernel,".
                                        "url_imagen_kernel,".   
                                        "orden_imagen_kernel)".
            "VALUES ('$id_evento_imagen_kernel', ".
                    "'$url_imagen_kernel', ".  
                    "'$orden_imagen_kernel') ";

    return $this->acceso->query($sql);         
  }

  function eliminar( $id_imagen_kernel, 
                     $id_evento_imagen_kernel) {
    $sql =  "DELETE FROM imagen_kernel WHERE id_evento_imagen_kernel='".$id_evento_imagen_kernel."' AND id_imagen_kernel='".$id_imagen_kernel."'";

    return $this->acceso->query($sql);           
  }
}
?>
