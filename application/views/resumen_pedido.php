<article class="col-md-10">
	<a href="<?php echo base_url(); ?>agregar">Agregar Partida(s)</a> |
	<a href="<?php echo base_url(); ?>partidas">Ver Partida(s)</a>
	<br>

	<form class="form-horizontal" id="frmAccionReumenPedido" action="<?php echo base_url(); ?>PedidosController/AccionResumenPedido" method="POST">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Información</h3>
			</div>
			<div class="panel-body">

				<div class="col-sm-offset-2">
					<h3>Resultado del análisis de condiciones crediticias del pedio <span><?php echo $this->session->pedido; ?></span></h3>
					<p class="well well-sm">
						<?php echo $causa_retencion; ?>
					</p>
				</div>

				<div class="form-group">
					<label for="comentario" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<input type="text" id="comentario" name="comentario" class="form-control" placeholder="comentario obligatorio" autocomplete="off" autofocus>
					</div>
				</div>
				<div class="col-sm-offset-2 col-sm-10">

				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div id="msj_vta_min">

						</div>

						<input type="hidden" id="accion" name="accion" value="">
						<input type="submit" id="btnFinalizar" value="Finalizar" name='finalizar' class="btn btn-warning"/>
						<input type="submit" id="btnCancelar" value="Cancelar" name='cancelar' class="btn btn-danger">
					</div>
				</div>

			</div>
		</div>
	</form>
	<br>


	<!-- Paneles de información -->
	<div class="form-horizontal" id="ResumenPedido" >
		<!-- Panel Totales -->
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

		<!-- Panel Cliente -->
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
						<input type="text" name="nombre" value="<?php echo $nombre; ?>"  class="form-control" readonly>
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

		<!-- CPanel consignación -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Consignación</h3>
			</div>
			<div class="panel-body">


				<div class="form-group">
					<label for="consignacion" class="col-sm-2 control-label">Consignación:</label>
					<div class="col-sm-10">
						<input type="text" name="consignacion" value="<?php echo $consignacion; ?>"  class="form-control" readonly>
						<a href="<?php echo base_url(); ?>consignaciones">Cambiar</a>
					</div>
				</div>
				<div class="form-group">
					<label for="direccion" class="col-sm-2 control-label">Dirección:</label>
					<div class="col-sm-10">
						<input type="text" name="direccion" value="<?php echo $direccion; ?>"  class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="colonia" class="col-sm-2 control-label">Colonia:</label>
					<div class="col-sm-10">
						<input type="text" name="colonia" value="<?php echo $colonia; ?>"  class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
					<div class="col-sm-10">
						<input type="text" name="ciudad" value="<?php echo $ciudad; ?>"  class="form-control" readonly>
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
	</div>

</article>