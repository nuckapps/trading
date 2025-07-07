<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Kernel</title>

  	<!-- Fav Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../imagenes/logo_la_distribuidora.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../imagenes/logo_la_distribuidora.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../imagenes/logo_la_distribuidora.png">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/bootstrap.css">

  <!-- <script src="../lib/bootstrap.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  login
  <!-- Modal Background -->
  <div id="modal-background-" class="modal-background-"></div>

  <!-- Login -->
  <div id="modal-content-login" class="modal-content- modal-dialog" style="min-width: 300px !important;">
    <div class="modal-content" style="z-index: 2000;">
      <div class="modal-header">
        <span class="modal-title titulo_modal" id="login_titulo">Login</span>
      </div>
      <div class="modal-body">
        <form id="frm_login" class="needs-validation" novalidate
              style=" width: calc(100% - 10px);
                      padding-left: 10px;">  
          <div class="form-group row">
            <input type="hidden" id="id_producto" required>
          </div>
          <div class="form-group row">
            <!-- <label for="nombre_imagen" class="col-sm-3 col-form-label">Usuario:</label> -->
            <div class="col-sm-12">
              <input type="text" id="usuario" required placeholder="Usuario">
              <div class="invalid-feedback">
                Usuario es necesario.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <!-- <label for="orden_imagen" class="col-sm-3 col-form-label">Contraseña:</label> -->
            <div class="col-sm-12">
              <input type="password" id="contrasena" required placeholder="Contraseña">
              <div class="invalid-feedback">
                <span id="error_msg">Contraseña es necesaria.</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" id="_id_productos">
          </div>     
          <div class="modal-footer" style="border: 0px solid red; padding-right: 0; margin-right: -3.8px;">
            <div class="btn_holder" style="position: relative;">
              <span class="span_icon" style="padding-left: 4px; padding-right: 3.6px;">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
              </span>
              <button type="submit" class="span_text">
                Entrar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#frm_login').submit(function(e){
        console.log("Login!");
        e.preventDefault();

        // Validación de campos
        let valido = true;

        // Validar campo usuario (requerido)
        let usuario = $('#usuario').val();
        if (!usuario) {
          $('#usuario').addClass('is-invalid');
          valido = false;
        } else {
          $('#usuario').removeClass('is-invalid');
        }

        // Validar campo contrasena (requerido)
        let contrasena = $('#contrasena').val();
        if (!contrasena) {
          $('#error_msg').html('Contraseña es necesaria.');
          $('#contrasena').addClass('is-invalid');
          valido = false;
        } else {
          $('#contrasena').removeClass('is-invalid');
        }

        if (valido) {
          var formData = new FormData();
          formData.append('funcion', 'login_!$#');
          formData.append('usuario', $('#usuario').val());
          formData.append('contrasena', $('#contrasena').val());

          $.ajax({
            url: 'valida_usuario.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
            console.log(response);
              var json_response = JSON.parse(response);
              console.log('response: status: '+json_response.status);
              console.log('response: message '+json_response.message);

              if (json_response.status == "Ok") {
                // Manejo de cookies

                window.location.href = "../";
              } else if (json_response.status == "Error" && json_response.message == "Usuario/Contraseña Invalido") {
                $('#error_msg').html(json_response.message);
                $('#contrasena').addClass('is-invalid');
              } else {
                alert("Error: "+json_response.message);
              }
            },
            error: function(jqXHR, textStatus, errorThrown){
              console.log('Error AJAX: ', textStatus, errorThrown);
              console.log('Response Text: ', jqXHR.responseText);
            }
          });
        }
      });
    });
  </script>

  <script>
    document.getElementById('modal-background-').style.display = 'block';
    const modalContent = document.getElementById('modal-content-login');
    modalContent.style.display = 'block';
    setTimeout(() => {
      modalContent.style.opacity = '1';
      modalContent.style.transform = 'translate(-50%, -50%) translateY(0)';
    }, 10); // Pequeño retraso para asegurar que la transición se aplique

    window.onload = function() {
			document.getElementById("usuario").focus();
		};
  </script>
</body>