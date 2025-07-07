<?php
	//Verificar si existe la cookie de usuario
	if (!isset($_COOKIE['usuario'])) {
		// No hay cookie de usuario, redirigir al usuario a la página de inicio de sesión
		header('Location: login');
		exit;
	}

	$spread = 0.00;

	$x = 0.1;

	for ($i = 0.00; number_format($i,2) < number_format($x,2);) { 
			// echo "---------------------------------<br>";
			// echo "i-antes: ".$i."<br>";
			if (ultimo_decimal($i) % 2 == 0) {
					$spread = $spread + 0.08;
			} else {
					$spread = $spread + 0.06;
			}
			$i += 0.01;
			// echo "i-despues: ".$i."<br>";
			// echo "x: ".$x."<br>";
			// echo "spread: ".$spread."<br>";
	}
	// echo "---------------------------------<br>";
	// echo "<br>";

	function ultimo_decimal($numero) {
			$partes = explode(".", $numero);
			$ultimo_digito = end($partes);
			// echo "---------------------------------<br>";
			// echo "numero: ".$numero."<br>";
			if (strlen($ultimo_digito) === 1) {
					$ultimo_digito .= '0';
					// echo "---------------------------------<br>";
					// echo "ultimo_digito_: ".$ultimo_digito."<br>";
					$partes = explode(".", $ultimo_digito);
					$ultimo_digito = end($partes);
			}
			// echo "ultimo_digito: ".$ultimo_digito."<br>";
			return $ultimo_digito;
	}

	function calcularPorcentajeRiesgo($base, $pierdo, $pips, $lotaje, $stop, $profit) {
			//parametros input
			// $pips = 3.5;
			// $lotaje = 0.03;
			$copia_lotaje = $lotaje;

			// Spread
			$spread = 0.00;

			$x = $copia_lotaje;

			for ($i = 0.00; number_format($i,2) < number_format($x,2);) { 
					if (ultimo_decimal($i) % 2 == 0) {
							$spread = $spread + 0.08;
					} else {
							$spread = $spread + 0.06;
					}
					$i += 0.01;
			}
			
			$lotaje = $lotaje * 100000;

			// Stop Loss
			$pips_reales = abs($pips) / 10000;
			$pips_reales_nf = number_format($pips_reales, 5, '.', '');
			$resultado_op_profit = ($pips_reales_nf * $lotaje * 1);

			// Calcular la ganancia o pérdida total
			$gananciaPerdida = $resultado_op_profit;

			// Calcular el porcentaje de riesgo
			$porcentajeRiesgo = (($gananciaPerdida+$spread) / $base) * 100;
			$porcentajeRiesgo_neto = (($gananciaPerdida) / $base) * 100;
			
			// Stop Loss 
			$valor_bruto = number_format(($gananciaPerdida+$spread), 2);

			// Profit 1
			$pips_reales_profit = abs($profit) / 10000;
			$pips_reales_nf_profit = number_format($pips_reales_profit, 5, '.', '');
			$profit_real = ($pips_reales_nf_profit * $lotaje * 1) - $spread;

			// profit 0-1
			$profit_real_0_1 = $profit_real - $valor_bruto;

			// profit 0-0-1
			$profit_real_0_0_1 = $profit_real - ($valor_bruto * 2);

			// Cantidad de veces
			$stop = floor($stop / $porcentajeRiesgo);

			// Max Bruto
			$max_loss_bruto = $valor_bruto * $stop;

			// riesgo / beneficio
			$profit_max_1_1_1_1_1 = $profit_real * 5;
			$profit_min_1_1_1_1_1 = $profit_real_0_0_1 * 5;

			$profit_max_0_1_1_1_1 = ($profit_real * 4)-$max_loss_bruto;
			$profit_min_0_1_1_1_1 = ($profit_real_0_0_1 * 4)-$max_loss_bruto;

			$profit_max_0_0_1_1_1 = ($profit_real * 3)-($max_loss_bruto*2);
			$profit_min_0_0_1_1_1 = ($profit_real_0_0_1 * 3)-($max_loss_bruto*2);

			$profit_stop_loss_0_0_0 = ($max_loss_bruto*3)*-1;

			// Porcentaje profit real
			$porcentaje_diario_1 = (($profit_real) / $base) * 100;
			$porcentaje_diario_0_1 = (($profit_real_0_1) / $base) * 100;
			$porcentaje_diario_0_0_1 = (($profit_real_0_0_1) / $base) * 100;

			// Porcentaje profit semana
			$porcentaje_semana_max_1_1_1_1_1 = (($profit_max_1_1_1_1_1) / $base) * 100;
			$porcentaje_semana_min_1_1_1_1_1 = (($profit_min_1_1_1_1_1) / $base) * 100;

			$porcentaje_semana_max_0_1_1_1_1 = ((($profit_real * 4)-$max_loss_bruto) / $base) * 100;
			$porcentaje_semana_min_0_1_1_1_1 = ((($profit_real_0_0_1 * 4)-$max_loss_bruto) / $base) * 100;

			$porcentaje_semana_max_0_0_1_1_1 = ((($profit_real * 3)-($max_loss_bruto * 2)) / $base) * 100;
			$porcentaje_semana_min_0_0_1_1_1 = ((($profit_real_0_0_1 * 3)-($max_loss_bruto * 2)) / $base) * 100;

			// Riesgo semana
			$riesgo_semana_min_0_0_1_1_0 = ($profit_real * 2)-($max_loss_bruto*3);
			$riesgo_semana_max_0_0_1_1_0 = ($profit_real_0_0_1 * 2)-($max_loss_bruto*3);

			$riesgo_semana_min_0_0_1_0 = ($profit_real * 1)-($max_loss_bruto*3);
			$riesgo_semana_max_0_0_1_0 = ($profit_real_0_0_1 * 1)-($max_loss_bruto*3);

			// Porsentaje riesgo semana
			$porcentaje_riesgo_semana_min_0_0_1_1_0 = (($riesgo_semana_min_0_0_1_1_0) / $base) * 100;
			$porcentaje_riesgo_semana_max_0_0_1_1_0 = (($riesgo_semana_max_0_0_1_1_0) / $base) * 100;

			$porcentaje_riesgo_semana_min_0_0_1_0 = (($riesgo_semana_min_0_0_1_0) / $base) * 100;
			$porcentaje_riesgo_semana_max_0_0_1_0 = (($riesgo_semana_max_0_0_1_0) / $base) * 100;

			$porcentaje_semana_0_0_0 = (($profit_stop_loss_0_0_0) / $base) * 100;

			// Balances profit
			$total_balance_max_1_1_1_1_1 = $profit_max_1_1_1_1_1 + $base;
			$total_balance_min_1_1_1_1_1 = $profit_min_1_1_1_1_1 + $base;

			$total_balance_max_0_1_1_1_1 = $profit_max_0_1_1_1_1 + $base;
			$total_balance_min_0_1_1_1_1 = $profit_min_0_1_1_1_1 + $base;

			$total_balance_max_0_0_1_1_1 = $profit_max_0_0_1_1_1 + $base;
			$total_balance_min_0_0_1_1_1 = $profit_min_0_0_1_1_1 + $base;

			$total_balance_max_0_0_1_1_0 = $riesgo_semana_max_0_0_1_1_0 + $base;
			$total_balance_min_0_0_1_1_0 = $riesgo_semana_min_0_0_1_1_0 + $base;

			$total_balance_max_0_0_1_0 = $riesgo_semana_max_0_0_1_0 + $base;
			$total_balance_min_0_0_1_0 = $riesgo_semana_min_0_0_1_0 + $base;

			$total_balance_min_0_0_0 = $profit_stop_loss_0_0_0 + $base;

			$ratio = $porcentaje_diario_1 / $porcentajeRiesgo;

			// Devolver resultados
			return [
					'porcentajeRiesgo' => number_format($porcentajeRiesgo, 2),
					'porcentajeRiesgo_neto' => number_format($porcentajeRiesgo_neto, 2),
					'gananciaPerdida' => number_format($gananciaPerdida, 2),
					'profit_real' => number_format($profit_real, 2),
					'valor_bruto' =>number_format($valor_bruto, 2),
					'profit_real_0_1' => number_format($profit_real_0_1, 2),
					'profit_real_0_0_1' => number_format($profit_real_0_0_1, 2),
					'max_loss_bruto' => $max_loss_bruto,
					'profit_max_1_1_1_1_1' => $profit_max_1_1_1_1_1,
					'profit_min_1_1_1_1_1' => $profit_min_1_1_1_1_1,
					'profit_max_0_1_1_1_1' => $profit_max_0_1_1_1_1,
					'profit_min_0_1_1_1_1' => $profit_min_0_1_1_1_1,
					'profit_max_0_0_1_1_1' => $profit_max_0_0_1_1_1,
					'profit_min_0_0_1_1_1' => $profit_min_0_0_1_1_1,
					'profit_stop_loss_0_0_0' => $profit_stop_loss_0_0_0,
					'porcentaje_diario_1' => $porcentaje_diario_1,
					'porcentaje_diario_0_1' => $porcentaje_diario_0_1,
					'porcentaje_diario_0_0_1' => $porcentaje_diario_0_0_1,
					'porcentaje_semana_max_1_1_1_1_1' => $porcentaje_semana_max_1_1_1_1_1,
					'porcentaje_semana_min_1_1_1_1_1' => $porcentaje_semana_min_1_1_1_1_1,
					'porcentaje_semana_max_0_1_1_1_1' => $porcentaje_semana_max_0_1_1_1_1,
					'porcentaje_semana_min_0_1_1_1_1' => $porcentaje_semana_min_0_1_1_1_1,
					'porcentaje_semana_max_0_0_1_1_1' => $porcentaje_semana_max_0_0_1_1_1,
					'porcentaje_semana_min_0_0_1_1_1' => $porcentaje_semana_min_0_0_1_1_1,
					'porcentaje_semana_0_0_0' => $porcentaje_semana_0_0_0,
					'riesgo_semana_min_0_0_1_1_0' => $riesgo_semana_min_0_0_1_1_0,
					'riesgo_semana_max_0_0_1_1_0' => $riesgo_semana_max_0_0_1_1_0,
					'riesgo_semana_min_0_0_1_0' => $riesgo_semana_min_0_0_1_0,
					'riesgo_semana_max_0_0_1_0' => $riesgo_semana_max_0_0_1_0,
					'porcentaje_riesgo_semana_min_0_0_1_1_0' => $porcentaje_riesgo_semana_min_0_0_1_1_0,
					'porcentaje_riesgo_semana_max_0_0_1_1_0' => $porcentaje_riesgo_semana_max_0_0_1_1_0,
					'porcentaje_riesgo_semana_min_0_0_1_0' => $porcentaje_riesgo_semana_min_0_0_1_0,
					'porcentaje_riesgo_semana_max_0_0_1_0' => $porcentaje_riesgo_semana_max_0_0_1_0,
					'total_balance_max_1_1_1_1_1' => $total_balance_max_1_1_1_1_1,
					'total_balance_min_1_1_1_1_1' => $total_balance_min_1_1_1_1_1,
					'total_balance_max_0_1_1_1_1' => $total_balance_max_0_1_1_1_1,
					'total_balance_min_0_1_1_1_1' => $total_balance_min_0_1_1_1_1,
					'total_balance_max_0_0_1_1_1' => $total_balance_max_0_0_1_1_1,
					'total_balance_min_0_0_1_1_1' => $total_balance_min_0_0_1_1_1,
					'total_balance_max_0_0_1_1_0' => $total_balance_max_0_0_1_1_0,
					'total_balance_min_0_0_1_1_0' => $total_balance_min_0_0_1_1_0,
					'total_balance_max_0_0_1_0' => $total_balance_max_0_0_1_0,
					'total_balance_min_0_0_1_0' => $total_balance_min_0_0_1_0,
					'total_balance_min_0_0_0' => $total_balance_min_0_0_0,
					'pips' => $pips,
					'lotaje' => $copia_lotaje,
					'stop' => $stop,
					'spread' => number_format($spread, 2),
					'ratio' => number_format($ratio, 2)
			];
	}

	function calcular() {
			if (isset($_POST['lotaje']))
					$lotaje = floatval($_POST['lotaje']);
			else $lotaje = 0;

			if (isset($_POST['pips']))
					$pips = floatval($_POST['pips']);
			else $pips = 0;

			if (isset($_POST['baseDinero']))
					$baseDinero = floatval($_POST['baseDinero']);
			else $baseDinero = 0;

			if (isset($_POST['cantidadPerdida'])) 
					$cantidadPerdida = floatval($_POST['cantidadPerdida']);
			else $cantidadPerdida = 0;

			if (isset($_POST['stop'])) 
					$stop = floatval($_POST['stop']);
			else $stop = 0;

			if (isset($_POST['profit'])) 
					$profit = floatval($_POST['profit']);
			else $profit = 0;

			$resultados = calcularPorcentajeRiesgo($baseDinero, $cantidadPerdida, $pips, $lotaje, $stop, $profit);

			header('Content-Type: application/json');
			echo json_encode($resultados);
			exit;
	}

	// Manejar la entrada del formulario y devolver resultados en formato JSON
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			calcular();
	}
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Trading</title>
	<link rel="icon" type="image/x-icon" href="images/debian.png">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Just Testing" />
	<meta name="keywords" content="Stocks, Forex, Trading" />
	<meta name="author" content="Jhon Nuck" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Css styles -->
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" href="css/flexslider.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- JavaScript lib -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="lib/jquery.easytabs.min.js" type="text/javascript"></script>
	<script src="lib/jquery.quicksand.js" type="text/javascript"></script>
	<script src="lib/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="lib/jquery.flexslider.js" type="text/javascript"></script>
	<script src="lib/custom.js" type="text/javascript"></script>

	<style>
		@font-face {
			font-family: orange_juice;
			src: url(fresh_fruit.ttf);
		}
		html {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
			color: #444;
		}

		form {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
		}

		a {
			color: white;
		}
		.tabla_riesgo_beneficio_semana {
			border-collapse: collapse;
			width: 100%;
			margin-left: 10px;
			margin-top: 8px;
			/* border-bottom: 1px solid #FF6E22;
			border-left: 1px solid #FF6E22; */
		}

		.tabla_riesgo_beneficio_semana td {
			padding-left: 5px;
			border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22;
		}

		.tabla_riesgo_beneficio_semana tr {
			padding: 0;
			border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22;
		}

		.tabla_contenedor_resultado{
			width: 100%;
			/* border: 1px solid orange; */
		}

		.tabla_contenedor_resultado td:nth-child(2) {
			padding-left: 120px;
		}

		.tabla_beneficio_diario {
			border-collapse: collapse;
			width: 100%;
			margin-left: 10px;
			margin-top: 8px;
			/* border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22; */
		}

		.tabla_beneficio_diario td {
			padding-left: 5px;
			border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22;
			margin-left: 20px;
		}

		.tabla_beneficio_diario tr {
			padding: 0;
			/* border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22; */
		}

		/*  */
		.tabla_riesgo {
			border-collapse: collapse;
			width: 100%;
			margin-left: 10px;
			margin-top: 8px;
			/* border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22; */
		}

		.tabla_riesgo td {
			padding-left: 5px;
			border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22;
		}

		.tabla_riesgo tr {
			padding: 0;
			border-collapse: collapse;
			border-bottom: 1px dotted #FF6E22;
      border-top: 1px dotted #FF6E22;
			border-left: 1px dotted #FF6E22;
      border-right: 1px dotted #FF6E22;
		}

		.titulo {
			font-size: 13px;
			font-weight: bold;
			color: #444;
		}

		.titulo:before {
			content: "> ";
			color: #ff6E22;
			font-weight: normal; 
		}

		.resultado_dinero {
			color: #ff6E22;
		}

		.resultado {
			border: 1px solid red;
		}

		.tux {
			font-size: 18px; 
			position: relative; 
			top: -3.2px; 
			left: 15px; 
			color: #444; 
			cursor: pointer;
			-moz-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			-ms-transition: all 0.3s ease-in-out;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.2s ease-in-out;
		}

		.tux:hover {
			color: #ff6E22; 
		}

		.footer_arrow {
			position: absolute;
			width: 0;
			height: 0;
			/* border-left: 12px solid transparent;
			border-right: 12px solid transparent;
			border-bottom: 11px solid #6d6e71; */
			border-left: 9px solid transparent;
			border-right: 9px solid transparent;
			border-bottom: 11px solid #444;
			right: 21px;
			top: -11px;
			
		}
		
		.btn_holder {
      color: #fff; 
      display: table;
    }

    .btn_holder .span_icon {
      background-color: #FF6E22; 
      padding: 3px 2px;
      display: table-cell;
      vertical-align: middle;
    }

    .btn_holder .span_text {
      all: unset;
      width: auto; 
      background-color: #444; 
      padding: 3px 5px; 
      display: table-cell;
      vertical-align: middle;
      cursor: pointer;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      -ms-transition: all 0.3s ease-in-out;
      -webkit-transition: all 0.3s ease-in-out;
      transition: all 0.2s ease-in-out;
    }

    .btn_holder .span_text:hover {
      background-color: #FF6E22;
    }

	  .font_btn {
			color: white; 
			font: 11px Arial, Georgia, sans-serif;
		}

		textarea,
    input[type="text"],
    input[type="password"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="date"],
    input[type="month"],
    input[type="time"],
    input[type="week"],
    input[type="number"],
    input[type="email"],
    input[type="url"],
    input[type="search"],
    input[type="tel"],
    input[type="color"],
    select,
    .select,
    .select-style,
    .uneditable-input {   
      /* border-color: #e5e5e5; */
			/* border-color: #FF6E22; */
			border: 0.5px solid #df6d36;
    }

		textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    select:focus,
    .select:focus,
    .select-style:focus,
    .uneditable-input:focus {   
      /* border-color: #FF6E22; */
			border: 1px solid #FF6E22;
      box-shadow: none;
      outline: 0 none;
      color: #ff6E22;
      padding: 3px 5px;
    }

		.invalid-feedback {
			display: none;
			color: #dc3545;
			font-size: 9px;
			margin-top: -13px;
			margin-bottom: 4px;
		}

		.valid-feedback {
			display: block;
		}

		.td_form {
			padding-left: 25px;
		}
	</style>
<body>
	<!--Page Wrraper-->
	<div id="wrapper" class="clearfix">
		<!--Page Header-->
		<header id="header" class="clearfix">
			<div id="innerHeader" class="clearfix">
				<figure id="logo">
					<!-- <img src="images/debian.png" alt="" width="48"/> -->
				</figure>
			</div>
		</header>
		<!--End Page Header-->

		<!--Main nav-->
		<nav id="mainNav">
			<div id="innerNav">
				<ul class="tabs clearfix">
					<li><a class="tab-contact" href="#contact">Cambio</a></li>
					<li><a class="tab-portfolio" href="#calculadora">Calculadora</a></li>
					<li><a class="tab-eventos" href="#eventos">Eventos</a></li>
					<li><a class="tab-services" href="#services">Horarios</a></li>
					<li><a id="logout-btn" class="tab-salir" href="#salir"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 1.1em;"></i></a></li>
				</ul>
			</div>
		</nav>
		<!--End main nav-->

		<!-- Tabs Container-->
		<section id="tabsContainer" class="clearfix">
			
			<!--Cambio Tab-->
			<article id="contact" class="clearfix">
				<div id="portfolioHolder">
					<div id="ourServices">
						<h2>USD / COP</h2>
						<br>
						<div class="btn_holder" style="left: 10px; position: relative; display: inline;" class="font_btn">
							<span class="span_icon">$</span>
							<span class="span_text">
								<a id="exchange" href="https://www.google.com/search?q=dollar+to+cop" target="_blank">
									<?php //include 'exchange.php';?>
								</a>
							</span>
						</div>
						<i id="tux" class="tux fa fa-refresh"></i>
					</div>
				</div>
			</article>

			<!--Calculadora Tab-->
			<article id="calculadora" class="clearfix">
				<div id="portfolioHolder">
					<div id="ourServices">
						<h2>Calculadora Forex</h2>
						<form id="calculoForm" style="margin-left: 10px;">
							<table>
								<tr>
									<td><label for="lotaje">Lotes:</label></td>
									<td class="td_form">
										<input type="text" name="lotaje" id="lotaje" required placeholder="0">
										<div id="valid_lotaje" class="invalid-feedback">
											Lotes es necesario.
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="pips">S/L:</label></td>
									<td class="td_form">
										<input type="text" name="pips" id="pips" required placeholder="0">
										<div id="valid_pips" class="invalid-feedback">
											S/L es necesario.
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="profit">T/P:</label></td>
									<td class="td_form">
										<input type="text" name="profit"  id="profit" required  placeholder="0">
										<div id="valid_profit" class="invalid-feedback">
											T/P es necesario.
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="baseDinero">Balance:</label></td>
									<td class="td_form">
										<input type="text" name="baseDinero"  id="baseDinero" oninput="agregarDollar()" required  placeholder="$">
										<div id="valid_baseDinero" class="invalid-feedback">
											Balance es necesario.
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="stop">Max. Loss:</label></td>
									<td class="td_form">
										<input type="text" name="stop"  id="stop" oninput="agregarPorcentaje()" required  placeholder="%">
										<div id="valid_stop" class="invalid-feedback">
											Max. Loss es necesario.
										</div>
									</td>
								</tr>
								<tr>
									<td><label for="neto">R/B Semana:</label></td>
									<td class="td_form"><input type="checkbox" id="neto"></td>
								</tr>
							</table>
							<br>
							<div class="btn_holder" style="left: 2px; position: relative;">
								<span class="span_icon" style="padding-left: 5px; padding-right: 5px;"><i class="fa fa-calculator" aria-hidden="true"></i></span>
								<button type="button" class="span_text" onclick="calcularResultado()">
									Calcular
								</button>
							</div>
        		</form>
						<br>
						<div id="resultados">
							<!-- Contenedor de Resultados -->
						</div>
					</div>
				</div>
			</article>

			<article id="services" class="clearfix">
				<div id="ourServices">
					<h2>Horarios del Mercado</h2>
					<br>
					<div class="btn_holder" style="left: 10px; position: relative;" class="font_btn">
						<span class="span_icon"><i class="fa fa-link" aria-hidden="true"></i></span>
						<span class="span_text">
							<a href="https://www.investing.com/tools/market-hours" target="_blank">Investing</a>
						</span>
					</div>
				</div>
			</article>
			
			<article id="eventos" class="clearfix">
				<div id="ourServices">
					<h2>Mejores Eventos</h2>
					<!-- <br>
					<button type="button" class="span_text" onclick="try_y()">
						Try
					</button> -->
					<!-- <div style="margin-left: 10px; padding-top: 20px;"> -->
						<!-- <iframe src="http://192.168.1.14/" width="800" height="750">
							<p>Tu navegador no permite iframes.</p>
						</iframe> -->
						<object id="iframe" type="text/html" data="eventos">
							Tu navegador no permite objetos.
						</object>
					<!-- </div> -->
				</div>
			</article>

		</section>
		<!-- End tabs Container-->
		<!-- Page Footer-->
		<footer id="pageFooter">
			<div id="footerInner" class="clearfix">
				<!-- <div class="footerArrow"></div> -->
				<div class="footer_arrow"></div>
				<p style="float: right;">n&#181;&#162;k © <?php echo date("Y"); ?> </p>
				<!-- <p>----- | -----</p> -->
			</div>
		</footer>
		<!--End Page Footer-->
		<!--End Tabs Container-->
	</div>
	<!--End Page Wrapper-->
	<script>
		var mostrar_neto = false;
		$(document).ready(function(){
			$('#neto').change(function(){
				if($(this).is(':checked')){
					console.log('Checkbox marcado');
					mostrar_neto = true;
				} else {
					console.log('Checkbox desmarcado');
					mostrar_neto = false;
				}
			});
		});

		function agregarDollar() {
				var input = document.getElementById("baseDinero");
				var valor = input.value;
				var valorSinPorcentaje = valor.replace(/\$/g, ''); // Eliminar el símbolo de dollar
				var v2 = "$" + valorSinPorcentaje;
				input.value = v2;
		}

		function agregarPorcentaje() {
				var input = document.getElementById("stop");
				var valor = input.value;
				var valorSinPorcentaje = valor.replace(/%/g, ''); // Eliminar el símbolo de porcentaje
				input.value = valorSinPorcentaje + "%";
		}

		function signo(valor) {
				var valor = valor.replace(/\$/g, '');
				if (valor < 0) {
						return "-$"+Math.abs(valor).toFixed(2);
				} else {
						return "$"+Math.abs(valor).toFixed(2);
				}
		}

		function signo_porcentaje(valor) {
				var valor = valor.replace(/%/g, '');
				console.log("valor: "+valor);
				if (valor < 0) {
						return "-"+Math.abs(valor).toFixed(2)+"%";
				} else {
						return Math.abs(valor).toFixed(2)+"%";
				}
		}

		function calcularResultado() {
			var pips = $('#pips').val();
			var lotaje = $('#lotaje').val();
			var baseDinero = $('#baseDinero').val().replace(/\$/g, '');
			var cantidadPerdida = $('#cantidadPerdida').val();
			var stop = $('#stop').val().replace(/%/g, '');
			var profit = $('#profit').val();

			var valido = true;

			// let volatilidad = $('#volatilidad').val();
			if (!lotaje) {
				console.log("lotaje: error")
				$('#valid_lotaje').addClass('valid-feedback');
				valido = false;
			} else {
				console.log("lotaje: ok")
				$('#valid_lotaje').removeClass('valid-feedback');
			}

			if (!pips) {
				console.log("pips: error")
				$('#valid_pips').addClass('valid-feedback');
				valido = false;
			} else {
				console.log("pips: ok")
				$('#valid_pips').removeClass('valid-feedback');
			}

			if (!profit) {
				console.log("profit: error")
				$('#valid_profit').addClass('valid-feedback');
				valido = false;
			} else {
				console.log("profit: ok")
				$('#valid_profit').removeClass('valid-feedback');
			}

			if (!baseDinero) {
				console.log("baseDinero: error")
				$('#valid_baseDinero').addClass('valid-feedback');
				valido = false;
			} else {
				console.log("baseDinero: ok")
				$('#valid_baseDinero').removeClass('valid-feedback');
			}

			if (!stop) {
				console.log("stop: error")
				$('#valid_stop').addClass('valid-feedback');
				valido = false;
			} else {
				console.log("stop: ok")
				$('#valid_stop').removeClass('valid-feedback');
			}

			if (valido) {
				$.ajax({
					url: '', // La URL es la misma página actual
					type: 'POST',
					data: { 
						pips: pips, 
						lotaje: lotaje, 
						baseDinero: baseDinero, 
						cantidadPerdida: cantidadPerdida,
						stop: stop,
						profit: profit
					},
						dataType: 'json',
						success: function(data) {
							var porciento = ((data.gananciaPerdida * data.stop) / baseDinero) * 100;
							var porciento_max = ((data.max_loss_bruto) / baseDinero) * 100;
							var neto = "";
							if(false) {
								neto = 
								"<tr>"+
									"<td>"+
										"<div style='padding: 5px;'><span class='beneficio_diario'>Riesgo (Neto):</span>"+
									"</td>"+   
									"<td>"+
										"<span style='font-weight: bold;; color: #eee;'>$" + data.porcentajeRiesgo_neto + "</span></div>" +
									"</td>"+
								"</tr>"+
								"<tr>"+
									"<td>"+
										"<div style='padding: 5px;'><span class='beneficio_diario'>Valor Op (Neto):</span>"+
									"</td>"+   
									"<td>"+
										"<span style='font-weight: bold;; color: #eee;'>$" + data.gananciaPerdida + "</span></div>" +
									"</td>"+
								"</tr>"+
								"<tr>"+
									"<td>"+
										"<div style='padding: 5px;'><span class='beneficio_diario'>Valor Max Op (Neto):</span>"+
									"</td>"+
									"<td>"+
										"<span style='font-weight: bold;; color: #eee;'>$" + (data.gananciaPerdida * data.stop).toFixed(2) + 
										" ("+porciento.toFixed(2)+"%)</span></div>" +
									"</td>"+
								"</tr>";
							}
							var contenido_riesgo =
								"<div>"+
									"<span class='titulo' style='font-weight: bold;'>Riesgo / Diario</span>"+
									"<table class='tabla_riesgo'>"+
										neto+
										"<tr>"+
											"<td>"+
												"Riesgo Op: "+
											"</td>"+    
											"<td>"+
												"-" + data.porcentajeRiesgo + "%" +
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"Spread Op: "+
											"</td>"+    
											"<td>"+
												"<span class='resultado_dinero'>-$" + data.spread + "</span>" + 
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"Valor Op: "+
											"</td>"+   
											"<td>"+
												"<span class='resultado_dinero'>-$" + data.valor_bruto + "</span>" + 
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"Riesgo Max: "+
											"</td>"+  
											"<td>"+
												"-" + porciento_max.toFixed(2) + "%" +
											"</td>"+
										"</tr>"+ 
										"<tr>"+  
											"<td>"+
												"Spread Max: "+
											"</td>"+  
											"<td>"+
												"<span class='resultado_dinero'>-$" + (data.spread * data.stop).toFixed(2) + "</span>" + 
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"Valor Max: "+
											"</td>"+ 
											"<td>"+
											"<span class='resultado_dinero'>-$" + data.max_loss_bruto.toFixed(2) + "</span>" + 
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"Max Ops:"+
											"</td>"+ 
											"<td>"+
												data.stop + " Ops" +
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"Balance: "+
											"</td>"+  
											"<td>"+
											"<span class='resultado_dinero'>-$" + (baseDinero - data.max_loss_bruto).toFixed(2) + "</span>" + 
											"</td>"+
										"</tr>"+ 
									"</table>"+
								"</div>";

							var contenido_profit =
							"<div>"+
								"<span class='titulo' style='font-weight: bold;'>Beneficio / Diario</span>"+
								"<table class='tabla_beneficio_diario'>"+
									"<tr>"+
										"<td>"+
											"B/Max 1 :"+
										"</td>"+
										"<td>"+
											"<span class='resultado_dinero'>"+signo("$" + data.profit_real) + "</span>" +
											" ("+
											signo_porcentaje(data.porcentaje_diario_1.toFixed(2)) + 
											")"+
										"</td>"+
										"<td>"+
											" Balance: " + 
											"<span class='resultado_dinero'>"+signo("$" + (parseFloat(baseDinero)+parseFloat(data.profit_real)).toFixed(2))+ "</span>" +
										"</td>"+
									"</tr>"+ 
									"<tr>"+
										"<td>"+
											"B/Max 0-1: "+
										"</td>"+
										"<td>"+
											"<span class='resultado_dinero'>"+signo("$" + data.profit_real_0_1) + "</span>" + 
											" ("+
											signo_porcentaje(data.porcentaje_diario_0_1.toFixed(2)) + 
											")"+
										"</td>"+
										"<td>"+
											" Balance: " + 
											"<span class='resultado_dinero'>"+signo("$" + (parseFloat(baseDinero)+parseFloat(data.profit_real_0_1)).toFixed(2))+ "</span>" +
										"</td>"+
									"</tr>"+ 
									"<tr>"+
										"<td>"+
											"B/Max 0-0-1: "+
										"</td>"+
										"<td>"+
											"<span class='resultado_dinero'>"+signo("$" + data.profit_real_0_0_1) + "</span>" +  
											" ("+
											signo_porcentaje(data.porcentaje_diario_0_0_1.toFixed(2)) + 
											")"+
										"</td>"+
										"<td>"+
											" Balance: " +
											"<span class='resultado_dinero'>"+signo("$" + (parseFloat(baseDinero)+parseFloat(data.profit_real_0_0_1)).toFixed(2))+ "</span>" +
										"</td>"+
									"</tr>"+ 
									"<tr>"+
										"<td>"+
											"Ratio Op: "+
										"</td>"+
										"<td>"+
											data.ratio + 
										"</td>"+
										"<td>"+
										"</td>"+
									"</tr>"+
								"</table>"+
							"</div>";

							var contenido_riesgo_beneficio =
								"<div>"+
									"<span class='titulo' style='font-weight: bold;'>Riesgo / Beneficio / Semana</span>"+
									"<table class='tabla_riesgo_beneficio_semana'>"+
										"<tr>"+
											"<td>"+
												"B/Max 1-1-1-1-1: "+
											"</td>"+    
											"<td>"+
												signo("$" + data.profit_max_1_1_1_1_1.toFixed(2)) + 
												" ("+
												signo_porcentaje(data.porcentaje_semana_max_1_1_1_1_1.toFixed(2))+
												") "+
											"</td>"+  
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_max_1_1_1_1_1.toFixed(2))+
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"B/Min 1-1-1-1-1: "+
											"</td>"+
											"<td>"+
												signo("$" + data.profit_min_1_1_1_1_1.toFixed(2)) + 
												" ("+
												signo_porcentaje(data.porcentaje_semana_min_1_1_1_1_1.toFixed(2))+
												") "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_1_1_1_1_1.toFixed(2))+
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"B/Max 0-1-1-1-1: "+
											"</td>"+    
											"<td>"+
												signo("$" + data.profit_max_0_1_1_1_1.toFixed(2)) + 
												" ("+
												signo_porcentaje(data.porcentaje_semana_max_0_1_1_1_1.toFixed(2))+
												") "+
											"</td>"+   
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_max_0_1_1_1_1.toFixed(2))+
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"B/Min 0-1-1-1-1: "+
											"</td>"+  
											"<td>"+
												signo("$" + data.profit_min_0_1_1_1_1.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_semana_min_0_1_1_1_1.toFixed(2))+
												") "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_0_1_1_1_1.toFixed(2))+
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"B/Max 0-0-1-1-1: "+
											"</td>"+   
											"<td>"+
												signo("$" + data.profit_max_0_0_1_1_1.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_semana_max_0_0_1_1_1.toFixed(2))+
												" )"+
											"</td>"+  
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_max_0_0_1_1_1.toFixed(2))+
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"B/Min 0-0-1-1-1: "+
											"</td>"+  
											"<td>"+
												signo("$" + data.profit_min_0_0_1_1_1.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_semana_min_0_0_1_1_1.toFixed(2))+
												" ) "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_0_0_1_1_1.toFixed(2))+
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"R/Min 0-0-1-1-0: "+
											"</td>"+    
											"<td>"+
												signo("$" + data.riesgo_semana_min_0_0_1_1_0.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_riesgo_semana_min_0_0_1_1_0.toFixed(2))+
												" ) "+
											"</td>"+  
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_0_0_1_1_0.toFixed(2))+
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"R/Max 0-0-1-1-0: "+
											"</td>"+   
											"<td>"+
												signo("$" + data.riesgo_semana_max_0_0_1_1_0.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_riesgo_semana_max_0_0_1_1_0.toFixed(2))+
												" ) "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_max_0_0_1_1_0.toFixed(2))+
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"R/Min 0-0-1-0: "+
											"</td>"+     
											"<td>"+
												signo("$" + data.riesgo_semana_min_0_0_1_0.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_riesgo_semana_min_0_0_1_0.toFixed(2))+
												" ) "+
											"</td>"+  
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_0_0_1_0.toFixed(2))+
											"</td>"+   
										"</tr>"+  
										"<tr>"+
											"<td>"+
												"R/Max 0-0-1-0: "+
											"</td>"+  
											"<td>"+
												signo("$" + data.riesgo_semana_max_0_0_1_0.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_riesgo_semana_max_0_0_1_0.toFixed(2))+
												" ) "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_max_0_0_1_0.toFixed(2))+
											"</td>"+
										"</tr>"+ 
										"<tr>"+
											"<td>"+
												"S/L 0-0-0: "+
											"</td>"+  
											"<td>"+
												signo("$" + data.profit_stop_loss_0_0_0.toFixed(2)) + 
												" ( "+
												signo_porcentaje(data.porcentaje_semana_0_0_0.toFixed(2))+
												" ) "+
											"</td>"+
											"<td>"+
												"Balance: "+ 
												signo("$" +data.total_balance_min_0_0_0.toFixed(2))+
											"</td>"+
										"</tr>"+ 
									"</table>"+
								"</div>";

							var contenedor_resultado = 
								"<table class='tabla_contenedor_resultado'>"+
									"<tr>"+
										"<td style='margin: 50px;'>"+
											contenido_riesgo+
										"</td>"+
										"<td>"+
											contenido_profit+
										"</td>"+
									"</tr>"+
								"</table>";

							var contenedor_resultado_2 = "";
							if (mostrar_neto) {
								contenedor_resultado_2 = 
									"<br><table class='tabla_contenedor_resultado'>"+
										"<tr>"+
											"<td style='margin: 50px;'>"+
												contenido_riesgo_beneficio+
											"</td>"+
										"</tr>"+
									"</table>";
							} else {
								contenedor_resultado_2 = "";
							}

							$('#resultados').html(contenedor_resultado+contenedor_resultado_2);
						},
						error: function(error) {
							console.error('Error:', error);
						}
				});
			}
		}

		$('#tux').click(function() {
			update_exchange();
		});

		function update_exchange() {
			fetch('exchange.php')
				.then(response => response.text())
				.then(data => {
					document.getElementById('exchange').innerHTML = data;
				});
		}

		window.onload = function() {
			document.getElementById("lotaje").focus();
		};

		var y = 3;

		var height = 3;

		function try_y() {
			y = window.scrollY;
			console.log("[vera.sdf] try_y(): y: "+y);
			if (y == 0) {
				console.log("[vera.sdf] try_y(): y=0: "+y);
				// y=1;
			}
			console.log("[vera.sdf] try_y(): antes: "+y);
			// window.scrollTo(0, y);
			window.scrollTo({
						top: Math.abs(y), // Desplazamiento vertical en píxeles
						left: 0,   // Desplazamiento horizontal en píxeles
						behavior: 'smooth' // Animación suave del desplazamiento
				});
			console.log("[vera.sdf] try_y(): despues: "+y);
		}

		function datatable_height(height) {
			console.log("[vera.sdf] datatable_height(): height: "+height);
			$("#iframe").css({
				"width": "800",
				"height": (height + 81 + 41 + 20),
				"margin-left": 10,
				"padding-top":  20
				// "height": "400",
				// "border": "1px solid red"
				// top = 81px
				// bottom = 598px
				// total = 679px
			});
			// margin-left: 10px; padding-top: 20px;"
			// $("#iframe").width("800");
			// $("#iframe").height(height);
		}

		// function get_y() {
		// 	return window.scrollY;
		// }

		// document.addEventListener('DOMContentLoaded', function() {
    //   const inputs = document.querySelectorAll('input, select, textarea');

    //   inputs.forEach(input => {
    //     input.addEventListener('invalid', function() {
    //       const feedback = this.parentElement.querySelector('.invalid-feedback');
    //       if (feedback) {
    //         feedback.classList.add('active');
    //       }
    //     });

    //     input.addEventListener('input', function() {
    //       const feedback = this.parentElement.querySelector('.invalid-feedback');
    //       if (feedback) {
    //         feedback.classList.remove('active');
    //       }
    //     });
    //   });
    // });

		document.getElementById('logout-btn').addEventListener('click', function() {
      $.ajax({
        url: 'login/logout.php',
        type: 'POST',
        // data: formData,
        contentType: false,
        processData: false,
        success: function(response){
          var json_response = JSON.parse(response);
          console.log('delete_imagen: response: status: '+json_response.status);
          console.log('delete_imagen: response: message '+json_response.message);
          window.location.href = "login";
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log('Error AJAX: ', textStatus, errorThrown);
          console.log('Response Text: ', jqXHR.responseText);
        }
      });
    });
	</script>
</body>
</html>