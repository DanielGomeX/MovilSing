<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">
            Registrar cobranza
        </h2>

        <br>

        <!-- mostramos un panel de mensaje en caso de que exista un error al registrar una cobranza -->
        <div>
            <!-- Si esta seteada la variable error, entonces mostramos una alerta en color verde o rojo -->
            <?php if(isset($error)):
            ?>
            <div>
                <?php if($error===1):
                ?>
                <!-- mostramos alerta verde -->
                <div class="col-sm-offset-2 alert alert-danger" role="alert">
                    <?php echo $desc; ?>
                </div>
                <?php endif;
                ?>
            </div>
            <?php endif;
            ?>
        </div>

        <!-- FORMULARIO PARA LA CAPTURA DE LA COBRANZA -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>registrar_cobranza">

            <div class="form-group" >
                <label for="recibo" class="col-sm-2 control-label">No. Recibo:</label>
                <div class="col-sm-10">
                    <input type="text" id="recibo" name="recibo" value="<?php echo  set_value('recibo'); ?>" class="form-control" tabindex="1" autocomplete="off"/>
                    <?php echo form_error('recibo'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="importe" class="col-sm-2 control-label">Importe:</label>
                <div class="col-sm-10">
                    <input type="text" id="importe" name="importe" value="<?php echo  set_value('importe'); ?>" class="form-control" tabindex="2" autocomplete="off"/>
                    <?php echo form_error('importe'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>FORMA DE PAGO:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="formaPago" id="efectivo" value="efectivo" <?php echo  set_radio('formaPago', 'efectivo'); ?> tabindex="3"/>
                            Efectivo
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="formaPago" id="cheque" value="cheque" <?php echo  set_radio('formaPago', 'cheque'); ?> tabindex="4" />
                            Cheque
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="formaPago" id="transferencia" value="transferencia" <?php echo  set_radio('formaPago', 'transferencia'); ?> tabindex="5" />
                            Transferencia
                        </label>
                    </div>
                    <?php echo form_error('formaPago'); ?>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <p class="form-control-static"><strong>BANCO:</strong></p>
                </div>

                <div class="col-sm-offset-2 col-sm-10">

                    <select class="form-control" name="banco" >
                      <option selected disabled value="">Seleccione un banco</option>
                      <option value="BANCOMER" <?php echo  set_select('banco', 'BANCOMER');?> >BANCOMER</option>
                      <option value="BANAMEX" <?php echo  set_select('banco', 'BANAMEX');?> >BANAMEX</option>
                      <option value="BANORTE" <?php echo  set_select('banco', 'BANORTE');?> >BANORTE</option>
                      <option value="HSBC" <?php echo  set_select('banco', 'HSBC');?> >HSBC</option>
                      <option value="SANTANDER" <?php echo  set_select('banco', 'SANTANDER');?> >SANTANDER</option>
                      <option value="OTRO" <?php echo  set_select('banco', 'OTRO');?> >OTRO (Especifique en referencia)</option>
                      <option value="EFECTIVO" <?php echo  set_select('banco', 'EFECTIVO');?> >EFECTIVO </option>
                    </select>
                    <?php echo form_error('banco'); ?>
                </div>
            </div>


            <div class="form-group">
                <label for="referencia" class="col-sm-2 control-label">Referencia pago:</label>
                <div class="col-sm-10">
                    <input type="text" id="referencia" name="referencia" value="<?php echo  set_value('referencia'); ?>" class="form-control" placeholder="No. cheque o No. Transferencia..." tabindex="6" autocomplete="off"/>
                    <?php echo form_error('referencia'); ?>
                </div>
            </div>

            <div class="form-group" >
                <label for="fechaCobro" class="col-sm-2 control-label">Fecha para cobro:</label>
                <div class="col-sm-10">
                    <input type="date" id="fechaCobro" name="fechaCobro" min="<?php echo date("Y-m-d");?>" value="<?php echo  set_value('fechaCobro'); ?>" class="form-control" tabindex="7"/>
                    <?php echo form_error('fechaCobro'); ?>
                </div>
            </div>


            <div class="form-group" >
                <label for="comentario" class="col-sm-2 control-label">Comentario:</label>
                <div class="col-sm-10">
                    <input type="text" id="comentario" name="comentario" value="<?php echo  set_value('comentario'); ?>" class="form-control" tabindex="8" placeholder="Se recomienda incluir factura(s) que avala(n) el pago" autocomplete="off"/>
                    <?php echo form_error('comentario'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button  type="submit" id="btnCobranza" class="btn btn-warning " tabindex="9">
                        <i class="fa fa-money"></i>
                        Registar cobranza
                    </button>
                </div>
            </div>
        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->
