<?php
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	include '../modelo/ImagenKernel.php';

	$imagen_kernel = new ImagenKernel();

  if($_POST['funcion']=="nuevo"){
    try {
      $id_evento_imagen_kernel = $_POST['id_evento_imagen_kernel'];
      $nombre_imagen_kernel = $_POST['nombre_imagen_kernel'];
      $orden_imagen_kernel = $_POST['orden_imagen_kernel'];

      // Acceder a la imagen correctamente con $_FILES
      $grafico = $_FILES['url_imagen_kernel']['name'];
      $extension = pathinfo($grafico, PATHINFO_EXTENSION);
      $archivoTemporal = $_FILES['url_imagen_kernel']['tmp_name'];
      $directorio = "../graficos/"; 
			$directorio_bd = "graficos/"; 
      $url_imagen_kernel = $directorio . $nombre_imagen_kernel.".".$extension;
			$url_imagen_kernel_bd = $directorio_bd . $nombre_imagen_kernel.".".$extension;

      if (file_exists($url_imagen_kernel)) {
        throw new Exception('La imagen ya existe.');
      }
      
      // Mover la imagen al directorio
      if (move_uploaded_file($archivoTemporal, $url_imagen_kernel)) {
        $resultado = $imagen_kernel->nuevo( $id_evento_imagen_kernel, 
                                            $url_imagen_kernel_bd, 
                                            $orden_imagen_kernel);

        echo json_encode(['status' => 'Ok', 'message' => 'Imagen Creada']);
      } else {
        throw new Exception('Error Controller: ' . error_get_last()['message']);
        // echo "Error Controller ". error_get_last()['message'];
      }
    } catch (Exception $e) {
      // Registra el error en los registros del servidor
      error_log($e->getMessage());
      // Devuelve el mensaje de error al cliente
      echo json_encode(['status' => 'error', 'message' => 'Message: '.$e->getMessage()]);
      // http_response_code(500);
    }
  }

  if($_POST['funcion']=="eliminar"){ 
		try {
			$id_imagen_kernel = $_POST['id_imagen_kernel'];
			$id_evento = $_POST['id_evento'];
      $url_imagen_kernel = $_POST['url_imagen_kernel'];

      // Emimina la imagen en el Servidor
      //---------------
      // Verificar si el archivo existe
      if (file_exists('../'.$url_imagen_kernel)) {
        // Eliminar el archivo
        if (unlink('../'.$url_imagen_kernel)) {
          $resultado = $imagen_kernel->eliminar($id_imagen_kernel, 
                                                $id_evento);
        } else {
          $resultado = -1;
          // echo "Ocurrió un error al intentar eliminar la imagen.";
        }
      } else {
        $resultado = 'graficos/'.$url_imagen_kernel;
        // echo "La imagen no existe.";
      }

			if ($resultado == 1) {
				echo json_encode(['status' => '1', 'message' => 'Imagen eliminada con exito.']);
			} else {
				echo json_encode(['status' => 'Error BD', 'message' => $resultado]);
			}

		} catch (Exception $e) {
			// Registra el error en los registros del servidor
			error_log($e->getMessage());
			// Devuelve el mensaje de error al cliente
			echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
			http_response_code(500);
		}
	}
?>