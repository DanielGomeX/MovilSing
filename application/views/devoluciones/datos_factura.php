<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Datos Factura para Devolución</h2>


        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>DevolucionesController/registrarDevolucion">

            <div class="form-group">
                <label for="factura" class="col-sm-2 control-label">Factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="factura" name="factura" value="<?php echo $factura ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="invcDate" class="col-sm-2 control-label">Fecha factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="invcDate" name="invcDate" value="<?php echo $invcDate ?>" class="form-control" tabindex="11" />
                </div>
            </div>

            <div class="form-group">
                <label for="referenciaEnviarJunto" class="col-sm-2 control-label">Se envió junto con:</label>
                <div class="col-sm-10">
                    <input type="text" id="referenciaEnviarJunto" name="referenciaEnviarJunto" value="<?php echo $referenciaEnviarJunto ?>" class="form-control" tabindex="9"  />
                </div>
            </div>

<!--             <div class="form-group">
                <label for="shipperid" class="col-sm-2 control-label">Embarque:</label>
                <div class="col-sm-10">
                    <input type="text" id="shipperid" name="shipperid" value="<?php echo $shipperid ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="custOrdNbr" class="col-sm-2 control-label">Pedido:</label>
                <div class="col-sm-10">
                    <input type="text" id="custOrdNbr" name="custOrdNbr" value="<?php echo $custOrdNbr ?>" class="form-control" tabindex="10" />
                </div>
            </div>

            <div class="form-group" >
                <label for="fechaProceso" class="col-sm-2 control-label">Fecha proceso:</label>
                <div class="col-sm-10">
                    <input type="text" id="fechaProceso" name="fechaProceso" value="<?php echo $fechaProceso ?>" class="form-control" tabindex="12" />
                </div>
            </div> -->

            <div class="form-group">
                <label for="fechaEnvio" class="col-sm-2 control-label">Fecha envio:</label>
                <div class="col-sm-10">
                    <input type="text" id="fechaEnvio" name="fechaEnvio" value="<?php echo $fechaEnvio ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="custid" class="col-sm-2 control-label">Cliente:</label>
                <div class="col-sm-10">
                    <input type="text" id="custid" name="custid" value="<?php echo $custid ?>" class="form-control" tabindex="5"  autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="cliente" class="col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" id="cliente" name="cliente" value="<?php echo $cliente ?>" class="form-control" tabindex="6" autocomplete="off"/>
                </div>
            </div>

<!--             <div class="form-group">
                <label for="zona" class="col-sm-2 control-label">Zona:</label>
                <div class="col-sm-10">
                    <input type="text" id="zona" name="zona" value="<?php echo $zona ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="vendedor" class="col-sm-2 control-label">Representante:</label>
                <div class="col-sm-10">
                    <input type="text" id="vendedor" name="vendedor" value="<?php echo $vendedor ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div> -->

            <div class="form-group" >

                <label for="transportista" class="col-sm-2 control-label">Transportista:</label>
                <div class="col-sm-10">
                    <input type="text" id="transportista" name="transportista" value="<?php echo $transportista ?>" class="form-control" tabindex="7" />
                </div>
            </div>

            <div class="form-group">
                <label for="fechaAcuseRecibo" class="col-sm-2 control-label">Fecha acuse recibo:</label>
                <div class="col-sm-10">
                    <input type="text" id="fechaAcuseRecibo" name="fechaAcuseRecibo" value="<?php echo $fechaAcuseRecibo ?>" class="form-control" tabindex="4" autocomplete="off"/>
                </div>
            </div>


            <div class="form-group">
                <label for="totPaquetes" class="col-sm-2 control-label">Total paquetes:</label>
                <div class="col-sm-10">
                    <input type="text" id="totPaquetes" name="totPaquetes" value="<?php echo $totPaquetes ?>" class="form-control" tabindex="14" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="pesoPaquetes" class="col-sm-2 control-label">Peso paquetes:</label>
                <div class="col-sm-10">
                    <input type="text" id="pesoPaquetes" name="pesoPaquetes" value="<?php echo $pesoPaquetes ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="monto" class="col-sm-2 control-label">Importe factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="monto" name="monto" value="<?php echo '$'.number_format($monto,2) ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="monto2" class="col-sm-2 control-label">Importe facturas:</label>
                <div class="col-sm-10">
                    <input type="text" id="monto2" name="monto2" value="<?php echo '$'.number_format($monto2,2) ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>


<!--             <div class="form-group">
                <label for="comentarioAcuse" class="col-sm-2 control-label">Comentario acuse:</label>
                <div class="col-sm-10">
                    <input type="text" id="comentarioAcuse" name="comentarioAcuse" value="<?php echo $comentarioAcuse ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div> -->

<!--             <div class="form-group">
                <label for="emailConfirmacion" class="col-sm-2 control-label">Email para confirmación:</label>
                <div class="col-sm-10">
                    <input type="text" id="emailConfirmacion" name="emailConfirmacion" value="" class="form-control" tabindex="16" autocomplete="off"/>
                </div>
            </div> -->


            <div class="form-group">
                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="29">
                    <i class="fa fa-pencil-square-o"></i>
                    Registrar devolución
                </button>

                <a class="btn btn-default" href="<?php echo base_url(); ?>devoluciones" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>


            </div>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
