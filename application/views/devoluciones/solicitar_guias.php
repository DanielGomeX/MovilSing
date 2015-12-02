<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Solicitar Guias</h2>

        <!-- FROMULARIO DE CAPTURA PARA LA SOLICITUD DE GUIAS -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>DevolucionesController/registrarGuiaDevolucion">

            <div class="form-group">
                <label for="remitente" class="col-sm-2 control-label">Remitente:</label>
                <div class="col-sm-10">
                    <input type="text" id="remitente" name="remitente" value="<?php echo  set_value('remitente'); ?>" class="form-control" tabindex="1" autocomplete="off" />
                    <?php echo form_error('remitente'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>Transportista:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">

                    <select class="form-control" name="transportista" tabindex="2">
                      <option selected disabled value="">Seleccione un Transportista</option>
                      <option value="ESTAFETA" <?php echo  set_select('transportista', 'ESTAFETA');?> >ESTAFETA</option>
                      <option value="ESTAFETA LTL" <?php echo  set_select('transportista', 'ESTAFETA LTL');?> >ESTAFETA TARIMA</option>
                      <option value="TINYPACK" <?php echo  set_select('transportista', 'TINYPACK');?> >TINYPACK</option>
                      <option value="VENCEDOR" <?php echo  set_select('transportista', 'VENCEDOR');?> >VENCEDOR</option>
                      <option value="AEROFLASH" <?php echo  set_select('transportista', 'AEROFLASH');?> >AEROFLASH</option>
                      <option value="PMM" <?php echo  set_select('transportista', 'PMM');?> >PMM</option>
                      <option value="PAQUETEXPRESS" <?php echo  set_select('transportista', 'PAQUETEXPRESS');?> >PAQUETEXPRESS</option>
                      <option value="OTRO" <?php echo  set_select('transportista', 'OTRO');?> >OTRO (Especifique)</option>
                    </select>
                    <?php echo form_error('transportista'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="oficina" class="col-sm-2 control-label">Oficina No:</label>
                <div class="col-sm-10">
                    <input type="text" id="oficina" name="oficina" value="<?php echo  set_value('oficina'); ?>" class="form-control" tabindex="3"  autocomplete="off" />
                    <?php echo form_error('oficina'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion1" class="col-sm-2 control-label">Calle:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion1" name="direccion1" value="<?php echo  set_value('direccion1'); ?>" class="form-control" tabindex="4" autocomplete="off" />
                    <?php echo form_error('direccion1'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="direccion2" class="col-sm-2 control-label">Número:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion2" name="direccion2" value="<?php echo  set_value('direccion2'); ?>" class="form-control" tabindex="5"  autocomplete="off"/>
                    <?php echo form_error('direccion2'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion3" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion3" name="direccion3" value="<?php echo  set_value('direccion3'); ?>" class="form-control" tabindex="6" autocomplete="off"/>
                    <?php echo form_error('direccion3'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-10">
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo  set_value('ciudad'); ?>" class="form-control" tabindex="7" />
                    <?php echo form_error('ciudad'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="estado" class="col-sm-2 control-label">Estado:</label>
                <div class="col-sm-10">
                    <input type="text" id="estado" name="estado" value="<?php echo  set_value('estado'); ?>" class="form-control" tabindex="8" autocomplete="off"/>
                    <?php echo form_error('estado'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="cp" class="col-sm-2 control-label">Codigo Postal:</label>
                <div class="col-sm-10">
                    <input type="text" id="cp" name="cp" value="<?php echo  set_value('cp'); ?>" class="form-control" tabindex="9" autocomplete="off"/>
                    <?php echo form_error('cp'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="paquetes" class="col-sm-2 control-label">Número de paquetes:</label>
                <div class="col-sm-10">
                    <input type="text" id="paquetes" name="paquetes" value="<?php echo  set_value('paquetes'); ?>" class="form-control" tabindex="10"  autocomplete="off"/>
                    <?php echo form_error('paquetes'); ?>
                </div>
            </div>

            <!--
            <div class="form-group">
                <label for="peso" class="col-sm-2 control-label">Peso total paquetes (Kg):</label>
                <div class="col-sm-10">
                    <input type="text" id="peso" name="peso" value="" class="form-control" tabindex="11" autocomplete="off"/>
                </div>
            </div>
            -->

            <div class="form-group">
                <label for="tel1" class="col-sm-2 control-label">Mi telefono:</label>
                <div class="col-sm-10">
                    <input type="text" id="tel1" name="tel1" value="<?php echo  set_value('tel1'); ?>" class="form-control" tabindex="11" autocomplete="off"/>
                    <?php echo form_error('tel1'); ?>
                </div>
            </div>

            <!--
            <div class="form-group">
                <label for="tel2" class="col-sm-2 control-label">Mi Tel. Celular:</label>
                <div class="col-sm-10">
                    <input type="text" id="tel2" name="tel2" value="" class="form-control" tabindex="13" autocomplete="off"/>
                </div>
            </div>
            -->


            <div class="form-group">
                <label for="atencion" class="col-sm-2 control-label">Atención A:</label>
                <div class="col-sm-10">
                    <input type="text" id="atencion" name="atencion" value="<?php echo  set_value('atencion'); ?>" class="form-control" tabindex="12" autocomplete="off" />
                    <?php echo form_error('atencion'); ?>
                </div>
            </div>


            <div class="form-group">

                <div>
                    <strong>
                    <p class="texto-centrado texto-color-azul">
                        Una vez registrados sus datos, le seran enviados por correo electronico los archivos PDF correspondientes a las guias de los paquetes solicitados.
                        En caso de que aplique para la paquetería seleccionada.
                    </p>

                    </strong>

                </div>

                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="13">
                    <i class="fa fa-pencil-square-o"></i>
                    Solicitar guias
                </button>

                <a class="btn btn-default" href="<?php echo base_url() ?>devoluciones" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Cancelar
                </a>

            </div>


            <!-- //datos generales -->

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
