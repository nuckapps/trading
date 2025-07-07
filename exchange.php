<?php
  //Verificar si existe la cookie de usuario
  if (!isset($_COOKIE['usuario'])) {
    // No hay cookie de usuario, redirigir al usuario a la página de inicio de sesión
    header('Location: login');
    exit;
  }
  // // URL del servicio web
  // $url = "http://apilayer.net/api/live?access_key=50b2f0479a434accd37cf5f89bb4f9d3&currencies=COP&source=USD&format=1";

  // // Inicializar cURL
  // $ch = curl_init($url);

  // // Establecer opciones de cURL
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // // Ejecutar la solicitud y obtener la respuesta
  // $response = curl_exec($ch);

  // // Cerrar la conexión cURL
  // curl_close($ch);

  // $data = json_decode($response);

  // $success = $data->success;
  // $terms = $data->terms;
  // $privacy = $data->privacy;
  // $timestamp = $data->timestamp;
  // $source = $data->source;
  // $usdToCOP = $data->quotes->USDCOP;

  // echo number_format($usdToCOP, 2, '.', '');






//   $curl = curl_init();

//   curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.apilayer.com/currency_data/live?source=USD&currencies=COP",
//   CURLOPT_HTTPHEADER => array(
//     "Content-Type: text/plain",
//     "apikey: 8zvLKjvLzUNGNVZRGWVvAEYydwyf9Rj6"
//   ),
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET"
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// $data = json_decode($response);

// $success = $data->success;
// $terms = $data->terms;
// $privacy = $data->privacy;
// $timestamp = $data->timestamp;
// $source = $data->source;
// $usdToCOP = $data->quotes->USDCOP;

// $COP = number_format($usdToCOP, 2, '.', '');

// if ($COP == 0.00) {
//   $COP = $data->message;
// }

// echo $COP;
// echo $response;




// set API Endpoint, access key, required parameters
$endpoint = 'convert';
$access_key = 'e6c2d6df20a69e580654e0e0248f5fef';

$from = 'USD';
$to = 'COP';
$amount = 1;

// initialize CURL:
$ch = curl_init('https://api.exchangerate.host/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the (still encoded) JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
echo $conversionResult['result'];
?>