<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../favicon.ico">

  <title>Login Movil SING </title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url();?>static/bootstrap3.3.5/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url();?>static/css/login.css" rel="stylesheet">

</head>

<body>

  <div class="container">
      <form class="form-signin" action="<?php echo base_url(); ?>login" method="post" >
      <h2 class="form-signin-heading">Movil SING</h2>
      <label for="username" class="sr-only">Usuario</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="usuario" autofocus autocomplete="off">
      <label for="password" class="sr-only">Contraseña</label>
      <input type="password" id="passowrd" name="password" class="form-control" placeholder="contraseña" >
      <?php echo validation_errors(); ?>
      <button class="btn btn-lg btn-warning btn-block" type="submit" value="Login">Ingresar</button>
    </form>

  </div> <!-- /container -->


  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

</body>
</html>