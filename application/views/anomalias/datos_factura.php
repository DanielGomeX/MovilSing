<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Datos Factura para Anomalia</h2>


        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form id="frmRegistrarAnomalia" class="form-horizontal" method="post" action="<?php echo base_url() ?>AnomaliasController/registrarAnomalia">

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


            <!--  
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>SELECCIONE CORRECTAMENTE EL TIPO DE ANOMALIA QUE VA A REGISTRAR</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label>
                            <!-- este objeto ejecuta un javascript, ver script llamado anomalias.js --
                            <input type="radio" name="tipoAnomalia" id="devolucionVenta" value="D"  />
                            DEVOLUCION DE VENTA
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <!-- este objeto ejecuta un javascript, ver script llamado anomalias.js --
                            <input type="radio" name="tipoAnomalia" id="reclamacionCalidad" value="R" />
                            DEVOLUCION POR CALIDAD
                        </label>
                    </div>

                </div>
            </div>
            -->


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>SELECCIONE LA CAUSA ATRIBUIBLE A LA ANOMALIA:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">

                    <select class="form-control" name="causaAnomalia" id="causaAnomalia">
                        <!--
                             esta parte se completa con el código que regresa la consulta ajax programada en el botón:
                            btnBuscarFacturas dentro del archivo script llamado anomalias.js
                        -->
                    </select>

                </div>
            </div>



            <div class="form-group">
                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="29">
                    <i class="fa fa-pencil-square-o"></i>
                    Registrar Anomalia
                </button>

                <a class="btn btn-default" href="<?php echo base_url(); ?>anomalias" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>

            </div>

        </form>




    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las anomalias -->
<script src="<?php echo base_url();?>static/js/anomalias.js"></script>
