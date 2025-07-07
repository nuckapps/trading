<?php
  //Verificar si existe la cookie de usuario
  if (!isset($_COOKIE['usuario'])) {
    // No hay cookie de usuario, redirigir al usuario a la página de inicio de sesión
    header('Location: login');
    exit;
  }
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