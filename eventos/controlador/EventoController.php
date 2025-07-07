<?php
	// ini_set('display_errors', 1);
	// error_reporting(E_ALL);
	include '../modelo/Evento.php';

	$evento = new Evento();
	// echo "<br><br>::EventoControlleer.php:: ".print_r($evento->mostrar(), true);

	function set_flag($divisa) {
		if ($divisa["divisa"] == "USD") {
			$divisa["divisa"] = '<span title="Estados Unidos" class="ceFlags United_States"></span>';
		}
		if ($divisa["divisa"] == "EUR") {
			$divisa["divisa"] = '<span title="Union Europea" class="ceFlags EUR"></span>';
		}
		if ($divisa["divisa"] == "GBP") {
			$divisa["divisa"] = '<span title="Reino Unido" class="ceFlags GBP"></span>';
		}
		if ($divisa["volatilidad"] == "1") {
			$divisa["volatilidad"] ='	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#ccc"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#ccc"/>
																</svg>';
		}
		if ($divisa["volatilidad"] == "2") {
			$divisa["volatilidad"] ='	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#ccc"/>
																</svg>';
		}
		if ($divisa["volatilidad"] == "3") {
			$divisa["volatilidad"] ='	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>
																<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18" fill="none">
																	<path   d="M9.82015 1.26457C9.51784 0.511747 8.45212 0.511744 8.1498 1.26457L6.19463 6.13336L0.959958 6.4883C0.150562 6.54318 -0.178765 7.55674 0.443791 8.0769L4.4701 11.4409L3.19007 16.5291C2.99215 17.3158 3.85434 17.9422 4.54141 17.5109L8.98498 14.7212L13.4285 17.5109C14.1156 17.9422 14.9778 17.3158 14.7799 16.5291L13.4999 11.4409L17.5262 8.0769C18.1487 7.55674 17.8194 6.54318 17.01 6.4883L11.7753 6.13336L9.82015 1.26457Z" 
																					fill="#FFA500"/>
																</svg>';
		}
		return $divisa;
	}

	if($_POST['funcion']=="listar"){
		$evento->mostrar();
		$json = array();
		foreach ($evento->eventos as $data) {
			$json['data'][]=set_flag($data);
		}
		$jsonstring = json_encode($json);
		echo $jsonstring;
	}

	if($_POST['funcion']=="nuevo"){
		$divisa = $_POST['divisa'];
		$fecha_hora = $_POST['fecha_hora'];
		$volatilidad = $_POST['volatilidad'];
		$evento_form = $_POST['evento'];
		$puntos_form = $_POST['puntos'];
		$actual = $_POST['actual'];
		$anterior = $_POST['anterior'];
		$grafico = $_POST['grafico'];

		// Acceder a la imagen correctamente con $_FILES
    $grafico = $_FILES['grafico']['name'];
		$extension = pathinfo($grafico, PATHINFO_EXTENSION);
    $archivoTemporal = $_FILES['grafico']['tmp_name'];
    $directorio = "../graficos/"; // Cambiar esta ruta por la correcta
    $rutaArchivo = $directorio . $divisa."_".$fecha_hora.".".$extension;
		$rutaArchivo_nuevo = "graficos/" . $divisa."_".$fecha_hora.".".$extension;
    
    // Mover la imagen al directorio
    if(move_uploaded_file($archivoTemporal, $rutaArchivo)){
			$resultado = $evento->nuevo($divisa, 
																	$fecha_hora, 
																	$volatilidad, 
																	$evento_form, 
																	$puntos_form, 
																	$actual, 
																	$anterior, 
																	$rutaArchivo_nuevo);

			echo "::Todo Ok::nuevo:: ".$resultado;
    } else {
			echo "Error Controller ". error_get_last()['message'];
    }
 }
?>
