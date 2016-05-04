<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Solicitar Guias</h2>

        <!-- FROMULARIO DE CAPTURA PARA LA SOLICITUD DE GUIAS -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>AnomaliasController/registrarGuia">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>Transportista:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">

                    <select class="form-control" name="transportista" tabindex="2">
                      <option selected disabled value="">Seleccione un Transportista</option>
                      <option value="EF" <?php echo  set_select('transportista', 'EF');?> >ESTAFETA</option>
                      <!--
                      <option value="EF LTL" <?php echo  set_select('transportista', 'EF LTL');?> >ESTAFETA TARIMA</option>
                      <option value="TINYPACK" <?php echo  set_select('transportista', 'TINYPACK');?> >TINYPACK</option>
                      <option value="VENCEDOR" <?php echo  set_select('transportista', 'VENCEDOR');?> >VENCEDOR</option>
                      <option value="AEROFLASH" <?php echo  set_select('transportista', 'AEROFLASH');?> >AEROFLASH</option>
                      <option value="PMM" <?php echo  set_select('transportista', 'PMM');?> >PMM</option>
                      <option value="PAQUETEXPRESS" <?php echo  set_select('transportista', 'PAQUETEXPRESS');?> >PAQUETEXPRESS</option>
                      <option value="OTRO" <?php echo  set_select('transportista', 'OTRO');?> >OTRO (Especifique)</option>
                      -->
                    </select>
                    <?php echo form_error('transportista'); ?>
                </div>
            </div>


            <h3>Datos Remitente</h3>

            <div class="form-group">
                <label for="oficina" class="col-sm-2 control-label">Oficina No:</label>
                <div class="col-sm-10">
                    <input type="text" id="oficina" name="oficina" value="<?php echo  set_value('oficina'); ?>" class="form-control" tabindex="3"  autocomplete="off" />
                    <?php echo form_error('oficina'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="calle" class="col-sm-2 control-label">Calle:</label>
                <div class="col-sm-10">
                    <input type="text" id="calle" name="calle" value="<?php echo  set_value('calle'); ?>" class="form-control" tabindex="4" autocomplete="off" />
                    <?php echo form_error('calle'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="numero" class="col-sm-2 control-label">Número:</label>
                <div class="col-sm-10">
                    <input type="text" id="numero" name="numero" value="<?php echo  set_value('numero'); ?>" class="form-control" tabindex="5"  autocomplete="off"/>
                    <?php echo form_error('numero'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="colonia" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-10">
                    <input type="text" id="colonia" name="colonia" value="<?php echo  set_value('colonia'); ?>" class="form-control" tabindex="6" autocomplete="off"/>
                    <?php echo form_error('colonia'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-10">
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo  set_value('ciudad'); ?>" class="form-control" tabindex="7" autocomplete="off"/>
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
                        Una vez registrados los datos datos, se generarán las guias de envío corrrespondientes en automático, las cuales le serán enviadas por correo electronico
                        como una archivo adjunto de formato PDF el cual posteriormente tendra que imprimir y pegar en los paquetes solicitados. <br>
                        En caso de que las guias no le lleguen a su correo debrá intentarlo nuevamente para verificar si fué un error de conexión o quizá exista 
                        algún problema, en caso de que el problema persiste, favor de reportarlo al departamento de T.I.
                    </p>
                    </strong>

                </div>

                <button  type="submit" class="col-sm-offset-2 btn btn-warning " tabindex="13">
                    <i class="fa fa-pencil-square-o"></i>
                    Solicitar guias
                </button>

                <a class="btn btn-default" href="<?php echo base_url() ?>anomalias" role="button">
                    <i class="fa fa-arrow-circle-left"></i>
                        Cancelar
                </a>

            </div>


            <!-- //datos generales -->

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las anomalias -->
<script src="<?php echo base_url();?>static/js/anomalias.js"></script>
