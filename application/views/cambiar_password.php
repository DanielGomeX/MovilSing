<article class="row">

  <div class="col-md-6 col-md-offset-2">
     <form class="form-signin" action="<?php echo base_url(); ?>principal/cambiarPassword" method="post" >

      	<h2 class="form-signin-heading">Cambio de Password</h2>

      	<label for="nuevoPassword" class="">Nuevo Password</label>
      	<input type="password" id="nuevoPassword" name="nuevoPassword" class="form-control" placeholder="Nuevo" autofocus autocomplete="off" value="<?php echo  set_value('nuevoPassword'); ?>">
      	<?php echo form_error('nuevoPassword'); ?>

      	<label for="confirmarPassword" class="">Confirmar Password</label>
      	<input type="password" id="confirmarPassword" name="confirmarPassword" class="form-control" placeholder="Confirmar" value="<?php echo  set_value('confirmarPassword'); ?>">
		<?php echo form_error('confirmarPassword'); ?>

		<br>
      <button class="btn btn-lg btn-warning btn-block" type="submit" value="Cambiar">Cambiar</button>

    </form>

  </div> <!-- /container -->
</article>

