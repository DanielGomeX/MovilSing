<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Registrar paquete(s)</h2>

        <form id="registrarPaquete" class="form-horizontal" method="post" action="<?php echo base_url() ?>DevolucionesController/registrarPaquete">

            <div class="form-group">
                <label for="guia" class="col-sm-2 control-label">No. Guia:</label>
                <div class="col-sm-10">
                    <input type="text" id="guia" name="guia" Class="form-control" tabindex="1" autocomplete="off" />
                    <?php echo form_error('guia'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="peso" class="col-sm-2 control-label">Peso (kg):</label>
                <div class="col-sm-10">
                    <input type="text" id="peso" name="peso" class="form-control" tabindex="2" autocomplete="off"/>
                    <?php echo form_error('peso'); ?>
                </div>
            </div>


            <div class="form-group">

                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="3">
                    <i class="fa fa-pencil-square-o"></i>
                    Agregar paquete
                </button>


                <a class="btn btn-default" href="<?php echo base_url() ?>DevolucionesController/solicitarGuias" role="button">
                    <i class="fa fa-file"></i>
                        Solicitar nuevas guias
                </a>

                <a class="btn btn-default" href="<?php echo base_url(); ?>DevolucionesController/mostrarDatosDevolucion/<?php  echo $_SESSION['devolucion']?>" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>

            </div>


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
                                    Peso
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($paquetes as $paquete):
                                ?>
                                <tr>
                                <td>
                                     <a href="<?php echo base_url(); ?>DevolucionesController/eliminarPaquete/<?php echo $paquete['IdGuia']; ?>">Eliminar</a>
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


                    <a class="btn btn-warning" href="<?php echo base_url(); ?>DevolucionesController/confirmarEnvioDevolucion " role="button">
                        <i class="fa fa-check"></i>
                            Confirmar envío
                    </a>



            <!-- permite mantener los campos de captura ocultos mientras no se haya seleccionado ningún producto -->
            <?php endif; ?>


        </form>




        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>DevolucionesController/registrarEnvioDevolucion">


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
                    <p class="form-control-static"><strong>Forma Autorizacion:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="autorizacion" id="Correo" value="Correo" <?php echo  set_radio('autorizacion', 'Correo'); ?> tabindex="3"/>
                            Correo Impreso
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="autorizacion" id="Hoja" value="Hoja" <?php echo  set_radio('autorizacion', 'Hoja'); ?> tabindex="4" />
                            Hoja Firmada
                        </label>
                    </div>
                    <?php echo form_error('autorizacion'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="motivo" class="col-sm-2 control-label">Motivo devolución:</label>
                <div class="col-sm-10">
                    <input type="text" id="motivo" name="motivo" value="" class="form-control" tabindex="4" autocomplete="off" />
                    <?php echo form_error('motivo'); ?>
                </div>
            </div>

            <div class="form-group">
                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="3">
                    <i class="fa fa-pencil-square-o"></i>
                    Enviar devolución
                </button>

                <a class="btn btn-default" href="<?php echo base_url(); echo $this->session->regresar; ?>" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Regresar
                </a>


            </div>
        </form>
        -->


    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
