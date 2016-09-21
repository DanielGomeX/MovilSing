<article class="row">

    <h2 class="texto-centrado">Registrar paquete(s)</h2>

    <div class="col-md-6 col-md-offset-3">

        <form id="registrarPaquete" class="form-group" method="post" action="<?php echo base_url() ?>AnomaliasController/registrarPaquete">

            <div class="form-group">
                <label for="guia">No. Guia / Codigo rastreo del paquete:</label>
                <input type="text" id="guia" name="guia" class="form-control"  tabindex="1" autocomplete="off" />
                    <?php echo form_error('guia'); ?>
            </div>

            <div class="form-group" >
                <label for="peso">Capture el peso (kilos) por cada paquete a enviar:</label>
                <input type="text" id="peso" name="peso" class="form-control" tabindex="2" autocomplete="off"/>
                <?php echo form_error('peso'); ?>
            </div>

            <div class="form-group">

                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="3">
                    <i class="fa fa-pencil-square-o"></i>
                    Agregar paquete
                </button>

                <a class="btn btn-default" href="<?php echo base_url() ?>AnomaliasController/solicitarGuias" role="button">
                    <i class="fa fa-file"></i>
                        Solicitar nuevas guias
                </a>

                <a class="btn btn-default" href="<?php echo base_url(); ?>AnomaliasController/mostrarDatosAnomalia/<?php  echo $_SESSION['id_anomalia']?>" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>

            </div>

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->


<!-- Muestra los paquetes capturados a la anomalia -->
<article class="row">

    <div class="col-md-8 col-md-offset-2">

            <!-- permite mantener los campos de captura ocultos mientras no se haya seleccionado ningún producto -->
            <?php if (isset($paquetes) && (count($paquetes)>0) ): ?>

                <!-- TABLA DE CLIENTES EN PLAN DE RUTA DEL DIA -->
                <div class="table-responsive">
                    <table id="tbPaquesParaEnvio" class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>

                                </th>
                                <th>
                                    Guia
                                </th>
                                <th>
                                    Transportista
                                </th>
                                <th>
                                    Peso (kgs)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($paquetes as $paquete):
                                ?>
                                <tr>
                                <td>
                                     <a href="<?php echo base_url(); ?>AnomaliasController/eliminarPaquete/<?php echo $paquete['IdGuia']; ?>">Eliminar</a>
                                </td>
                                <td>
                                    <?php echo $paquete['Guia']; ?>
                                </td>
                                <td>
                                    <?php echo utf8_encode($paquete['Transportista']); ?>
                                </td>
                                <td>
                                    <?php echo $paquete['Peso']; ?>
                                </td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

            <!-- permite mantener los campos de captura ocultos mientras no se haya seleccionado ningún producto -->
            <?php endif; ?>

    </div><!-- //columna -->

</article><!-- //renglon -->


<hr>


<article class="row">
    <div class="col-md-6 col-md-offset-3">


                <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form id="frmRegistrarEnvio" class="form-horizontal" method="post" action="<?php echo base_url() ?>AnomaliasController/registrarEnvioDevolucion">

            <!-- Datos Generales -->

            <div class="form-group">
                <label for="anomalia" class="col-sm-2 control-label">Anomalia No:</label>
                <div class="col-sm-10">
                    <input type="text" id="anomalia" name="anomalia" value="<?php echo $_SESSION['id_anomalia']; ?>" class="form-control" tabindex="1" autocomplete="off" />
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
                    Enviar Anomalia
                </button>

                <a class="btn btn-default" href="<?php echo base_url(); ?>AnomaliasController/mostrarDatosAnomalia/<?php  echo $_SESSION['id_anomalia']?>" role="button" tabindex="7">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>


            </div>
        </form>
    </div>
</article>


<!-- Cargamos el sript que se usa para las anomalias -->
<script src="<?php echo base_url();?>static/js/anomalias.js"></script>
