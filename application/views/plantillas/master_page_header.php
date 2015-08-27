<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?php $titulo; ?></title>

  <!-- **********ESTILOS GLOBALES**********-->

  <!-- Bootstrap -->
  <link href="<?php echo base_url();?>static/bootstrap3.3.5/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="<?php echo base_url();?>static/DataTables1.10.7/media/css/jquery.dataTables.css" rel="stylesheet">

  <link href="<?php echo base_url();?>static/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Mis estilos -->
  <link href="<?php echo base_url();?>static/css/master_page.css" rel="stylesheet">


  <!-- **********SCRIPTS GLOBALES********** -->

  <!-- jQuery -->
  <script src="<?php echo base_url();?>static/js/jquery-1.11.3.min.js"></script>


</head>
<body>
  <?php if (!isset($_SESSION['cliente'])): ?>
  <!-- Si NO existe una variable de sesion llamada cliente, entonces mostramos los menus disponibles -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="principal">Movil SING</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><?php echo anchor('#','Indicadores') ?></li>
          <li><?php echo anchor('planruta','Plan Ruta') ?></li>
          <li><?php echo anchor('#','Prospectos') ?></li>
          <li><?php echo anchor('#','Devoluciones') ?></li>
          <!-- Submenú Reportes -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><?php echo anchor('liberados','Pedidos Liberados') ?></li>
              <li><?php echo anchor('retenidos','Pedidos Retenidos') ?></li>
              <li><?php echo anchor('pendientes','Pedidos Pendientes') ?></li>
              <li role="separator" class="divider"></li>
              <li><?php echo anchor('visitas_periodo','Visitas Periodo') ?></li>
              <li><?php echo anchor('cobranza_periodo','Cobranza Periodo') ?></li>
            </ul>
          </li>

        </ul>

        <span class="navbar-text navbar-right"> Bienvenido usuario: <?php echo $this->session->usuario; ?> | <a href="<?php echo base_url();?>logout" class="navbar-link"><i class="fa fa-sign-out"></i> Salir</a></span>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <?php else: ?>
      <!-- Si existe una variable de sesion llamada cliente, entonces ocultamos el menu para completar
      de manera correcta el flujo de captura de un pedido -->
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="principal">Movil SING</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <span class="navbar-text navbar-right"> <a href="<?php echo base_url();?>Principal/salirPlanRuta" class="navbar-link"><?php echo $this->session->cliente.' '.$this->session->nombre_cliente; ?></a> | <a href="<?php echo base_url();?>logout" class="navbar-link"><i class="fa fa-sign-out"></i> Salir</a></span>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
    <?php endif; ?>
    <section class="container">


