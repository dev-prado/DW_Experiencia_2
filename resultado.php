<?php

// Función para evitar inyecciones
function Filtro($texto) {
  return htmlspecialchars(trim($texto), ENT_QUOTES | ENT_HTML5);
}

function Sexo($texto) {
    switch ($texto) {
        case 'm':
            $sexo = 'Masculino';
            break;
        case 'f':
            $sexo = 'Femenino';
            break;
    }
    return $sexo;
} 

// Variables
$enviado = isset($_POST['enviado']) ? (int) $_POST['enviado'] : 0;
$nombre = isset($_POST['nombre']) ? Filtro($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? Filtro($_POST['apellido']) : '';
$fecha= isset($_POST['fecha']) ? Filtro($_POST['fecha']) : '';
$sexo = isset($_POST['sexo']) ? Filtro($_POST['sexo']) : '';
$region = isset($_POST['region']) ? Filtro($_POST['region']) : '';

//Area de interes
$ciencia = isset($_POST['ciencia']) ? (int) $_POST['ciencia'] : 0;
$deportes = isset($_POST['deportes']) ? (int) $_POST['deportes'] : 0;
$pintura_rupestre = isset($_POST['pintura_rupestre']) ? (int) $_POST['pintura_rupestre'] : 0;
$videos_gatos = isset($_POST['videos_gatos']) ? (int) $_POST['videos_gatos'] : 0;

$web = isset($_POST['web']) ? Filtro($_POST['web']) : '';
$correo = isset($_POST['correo']) ? Filtro($_POST['correo']) : '';
$color = isset($_POST['color']) ? Filtro($_POST['color']) : '';

$error = '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Encuesta candidatos Valparaiso">
  <meta name="keywords" content="html, bootstrap, php, formulario, desarrollo, web">
  <meta name="author" content="Alfonso Javier Prado Sepúlveda">
  <title>Formulario enviado</title>
  <!-- CSS -->
  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="vendor/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <span style="padding-top: 10px;"></span>
<?php
// Mostrar contenido
    
if($enviado == 0) {
?>
<div class="alert alert-info">
  <i class="glyphicon glyphicon-info-sign"></i>
  <?php echo "No tiene permiso para abrir resultados." ?>
</div>
<a href="./" class="btn btn-warning">
  <i class="glyphicon glyphicon-chevron-left"></i>
  Volver
</a>
<?php 
} else {
    if(empty($nombre)) {
        $error = $error . 'Por favor, ingrese su nombre. <br />';
    }
    if(empty($apellido)) {
        $error = $error . 'Por favor, ingrese su apellido. <br />';
    } 
    if(empty($fecha)) {
        $error = $error . 'Por favor, ingrese su fecha de nacimiento. <br />';
    } 
    if(empty($sexo)) {
        $error = $error . 'Por favor, ingrese su sexo. <br />';
    }

    // Vista de error
    if(!empty($error)) {
    ?>
    <div class="alert alert-info">
      <i class="glyphicon glyphicon-info-sign"></i> <b>No a ingresado los campos obligatorios.</b><br />
      <?php echo $error; ?>
    </div>
    <a href="./" class="btn btn-warning">
      <i class="glyphicon glyphicon-chevron-left"></i>
      Volver
    </a>
    <?php
    }
    else {
    ?>
    <br>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Datos enviados</h3>
    </div>
    <div class="panel-body">
      <p>Muchas gracias <b><?php echo $nombre; ?></b> <b><?php echo $apellido; ?></b></p>
      <p>La siguiente información ha sido registrada:</p>
      <ul>
          <li>Fecha de nacimiento: <?php echo $fecha; ?></li>
          <li>Sexo: <?php echo Sexo($sexo); ?></li>
          <?php
            if(!empty($region)) {
                echo "<li>Region: $region</li>"; 
            }
            if(!empty($ciencia) or !empty($deportes) or !empty($pintura_rupestre) or !empty($videos_gatos)) {
                echo "<li>Áreas de interés:";
                if(!empty($ciencia)) {
                    echo ' Ciencia,';
                }
                if(!empty($deportes)) {
                    echo ' Deportes,';
                }
                if(!empty($pintura_rupestre)) {
                    echo ' Pintura rupestre,';
                }
                if(!empty($videos_gatos)) {
                    echo ' Videos de gatos';
                }
                echo "</li>";
            } 
            if(!empty($web)) {
                echo "<li>Pagina personal: $web</li>";
            }       
            if(!empty($correo)) {
                echo "<li>Correo electrónico: $correo</li>"; 
            }
            if(!empty($color)) {
                echo "<li>Color favorito: $color</li>";
            }
          ?>
      </ul>
    </div>
    <div class="panel-footer">
      <div class="text-right">
        <a href="./" class="btn btn-primary">
          <i class="glyphicon glyphicon-chevron-left"></i>
          Volver
        </a>
      </div>
    </div>
  </div>
    <?php
    }
}
?>
  <!-- Pie de página -->
  <footer>
    <div class="text-center">
      <i class="glyphicon glyphicon-leaf"></i>
      Desarrollado por Alfonso Prado
    </div>
  </footer>
</div>
   
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="vendor/raphael/raphael.min.js"></script>
<script src="vendor/morrisjs/morris.min.js"></script>
<script src="data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
</body>
</html>