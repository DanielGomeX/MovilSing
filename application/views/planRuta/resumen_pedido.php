<article class="row">

	<div class="col-md-8 col-md-offset-2">

		<!-- CONTENEDOR DE PANELES -->
		<div class="form-horizontal" >

			<!-- PANEL INFORMACION -->
			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">Información</h3>
				</div>

				<div class="panel-body">

					<a class="btn btn-default" role="button" href="<?php echo base_url(); ?>agregar">
						<i class="fa fa-plus"></i>
						Agregar Partida
					</a>
					<a class="btn btn-default" role="button" href="<?php echo base_url(); ?>partidas">
						<i class="fa fa-bars"></i>
						Ver partidas
					</a>

					<h3>Resultado del análisis de condiciones crediticias del pedido <span><?php echo $this->session->pedido; ?></span></h3>
					<p class="well well-sm">
						<?php echo $causa_retencion; ?>
					</p>

					<!-- FORMULARIO PARA GUARDAR O CANCELAR EL PEDIDO -->
					<form id="frmAccionReumenPedido" action="<?php echo base_url(); ?>PlanRutaController/AccionResumenPedido" method="POST">

						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" id="comentario" name="comentario" class="form-control" placeholder="comentario obligatorio" autocomplete="off" autofocus>
							</div>
						</div>

						<div id="msj_vta_min">
							<!-- AQUI SE MUESTRA EL MENSAJE DE VALIDACION CORRESPONDIENTE -->
						</div>

						<!--
							el objeto id=accion sirve para que se le asigne un valor dínamicamnete (finalizar o cancelar) mediante javaScript
							(ver archivo funciones.js) según se haya presionado alguno de los botones del formulario
						-->
						<input type="hidden" id="accion" name="accion" value="">

						<button type="submit" id="btnFinalizar" name='finalizar' value="Finalizar" class="btn btn-warning" >
							<i class="fa fa-floppy-o"></i>
							Finalizar
						</button>

						<button type="submit" id="btnCancelar" name='cancelar' value="Cancelar" class="btn btn-danger" >
							<i class="fa fa-remove"></i>
							Cancelar
						</button>

					</form>

				</div>

			</div>

			<!-- PANEL TOTALES -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Totales</h3>
				</div>

				<div class="panel-body">

					<div class="form-group">
						<label for="importe_min_venta" class="col-sm-2 control-label">Mínimo de Venta:</label>
						<div class="col-sm-10">
							<input type="text" name="importe_min_venta" value="<?php echo '$'.number_format($importe_min_venta); ?>"  class="form-control" readonly>
							<input type="hidden" id="importe_min_venta" value="<?php echo $importe_min_venta; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="importe" class="col-sm-2 control-label">Importe:</label>
						<div class="col-sm-10">
							<input type="text" name="importe" value="<?php echo '$'.number_format($importe); ?>"  class="form-control" readonly>
							<input type="hidden" id="importe" value="<?php echo $importe; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="iva" class="col-sm-2 control-label">Iva:</label>
						<div class="col-sm-10">
							<input type="text" name="iva" value="<?php echo '$'.number_format($iva); ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="total" class="col-sm-2 control-label">Total:</label>
						<div class="col-sm-10">
							<input type="text" name="total" value="<?php echo '$'.number_format($total); ?>"  class="form-control" readonly>
						</div>
					</div>

				</div>
			</div>

			<!-- PANEL CLIENTE -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Cliente</h3>
				</div>

				<div class="panel-body">

					<div class="form-group">
						<label for="pedido" class="col-sm-2 control-label">Pedido:</label>
						<div class="col-sm-10">
							<input type="text" id="pedido" name="pedido" value="<?php echo $this->session->pedido; ?>" class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="cliente" class="col-sm-2 control-label">Cliente:</label>
						<div class="col-sm-10">
							<input type="text" name="cliente" value="<?php echo $cliente; ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre:</label>
						<div class="col-sm-10">
							<input type="text" name="nombre" value="<?php echo utf8_encode($nombre); ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="tipo_cliente" class="col-sm-2 control-label">Tipo Cliente:</label>
						<div class="col-sm-10">
							<input type="text" name="tipo_cliente" value="<?php echo $tipo_cliente; ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="Condiciones Pago" class="col-sm-2 control-label">Condiciones Pago:</label>
						<div class="col-sm-10">
							<input type="text" name="cond_pago" value="<?php echo $cond_pago; ?>"  class="form-control" readonly>
						</div>
					</div>

				</div>
			</div>

			<!-- PANEL CONSIGNACION -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Consignación</h3>
				</div>

				<div class="panel-body">

					<div class="form-group">
						<label for="consignacion" class="col-sm-2 control-label">Consignación:</label>
						<div class="col-sm-10">
							<input type="text" name="consignacion" value="<?php echo $consignacion; ?>"  class="form-control" readonly>
							<a href="<?php echo base_url(); ?>consignaciones">
								<i class="fa fa-truck"></i>
								Cambiar
							</a>
						</div>
					</div>

					<div class="form-group">
						<label for="direccion" class="col-sm-2 control-label">Dirección:</label>
						<div class="col-sm-10">
							<input type="text" name="direccion" value="<?php echo utf8_encode($direccion); ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="colonia" class="col-sm-2 control-label">Colonia:</label>
						<div class="col-sm-10">
							<input type="text" name="colonia" value="<?php echo utf8_encode($colonia); ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
						<div class="col-sm-10">
							<input type="text" name="ciudad" value="<?php echo utf8_encode($ciudad); ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="municipio" class="col-sm-2 control-label">Municipio:</label>
						<div class="col-sm-10">
							<input type="text" name="municipio" value="<?php echo $municipio; ?>"  class="form-control" readonly>
						</div>
					</div>

					<div class="form-group">
						<label for="estado" class="col-sm-2 control-label">Estado:</label>
						<div class="col-sm-10">
							<input type="text" name="estado" value="<?php echo $estado; ?>"  class="form-control" readonly>
						</div>
					</div>

				</div>
			</div>

		</div> <!-- //contenedor paneles de información -->

	</div><!-- //columna -->

</article><!-- //renglon -->