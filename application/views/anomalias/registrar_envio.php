<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Confirmar Envío</h2>

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form id="frmRegistrarEnvio" class="form-horizontal" method="post" action="<?php echo base_url() ?>DevolucionesController/registrarEnvioDevolucion">

            <!-- Datos Generales -->

            <div class="form-group">
                <label for="anomalia" class="col-sm-2 control-label">Devolución No:</label>
                <div class="col-sm-10">
                    <input type="text" id="anomalia" name="anomalia" value="<?php echo $_SESSION['devolucion']; ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="factura" class="col-sm-2 control-label">Factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="factura" name="factura" value="<?php echo $_SESSION['factura']; ?>" class="form-control" tabindex="2" />
                </div>
            </div>

          <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>Seleccione la forma de autorizacion:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">

                        <label>
                            <input type="radio" name="autorizacion" id="Correo" value="Correo" tabindex="3"/>
                            Correo Impreso
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="autorizacion" id="Hoja" value="Hoja" tabindex="4" />
                            Hoja Firmada
                        </label>
                    </div>
                    <label for="autorizacion" class="error"><!-- esto es para que aparezca el mensaje en la parte de abajo -->
                </div>
            </div>

            <div class="form-group">
                <label for="motivo" class="col-sm-2 control-label">Motivo de devolución:</label>
                <div class="col-sm-10">
                    <input type="text" id="motivo" name="motivo" value="" class="form-control" tabindex="5" autocomplete="off" />
                </div>
            </div>

            <p class="texto-justificado texto-color-azul">
                Nota: Antes de enviar la devolución, debe contarse con la autorización del Gte. Regional, con la firma autógrafa o correo electronico.
                Dicha autorización debe anexarse a este registro con la mercancia; sin esta autorización, se devolvera el paquete al remitente,
                haciendosele el cargo de los gastos de paqueteria a quien lo envie. Al recibir la mercancia se pasará a Calidad Recibo que determinará
                si es apta para venta, en cuyo caso, se procedera a generar la Nota de Credito. Si se determina lo contrario, se devolverá la misma a quien la envió
                y se le hara el cargo tanto del envio a Aguascalientes como el regreso al remitente. En caso de que el error sea atribuible al cliente,
                debera firmar de aceptado dicho cargo; de lo contrario se aplicara el descuento al Representante de Ventas.
            </p>

            <div class="form-group">
                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="6">
                    <i class="fa fa-pencil-square-o"></i>
                    Enviar devolución
                </button>

                <a class="btn btn-default" href="<?php echo base_url(); echo $this->session->regresar; ?>" role="button" tabindex="7">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>


            </div>
        </form>



    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
