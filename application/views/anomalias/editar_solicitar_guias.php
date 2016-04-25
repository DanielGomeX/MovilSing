<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Solicitar Guias</h2>



        <!-- MENU DE NAVEGACION

        <div class="form-group">
            <ul class="nav nav-pills nav-justified ">
                <?php if ($status=='CAPTURA' || $status=='REV.VENDEDOR'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>AnomaliasController/mostrarProductosDevolucion/<?php echo $status ?>"><i class="fa fa-calendar-check-o"></i> Productos </a></li>
                <?php elseif ($status=='POR ENVIAR'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>"><i class="fa fa-calendar-check-o"></i> Enviar a Ags</a></li>
                <?php endif; ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>detalle"><i class="fa fa-money"></i> Ver detalle factura</a></li>
                    <li role="presentation"><a href="<?php echo base_url() ?>devoluciones"><i class="fa fa-money"></i> Regresar</a></li>
            </ul>
        </div>
        -->

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>">

            <!-- Datos Generales -->

            <div class="form-group">
                <label for="remitente" class="col-sm-2 control-label">Remitente:</label>
                <div class="col-sm-10">
                    <input type="text" id="remitente" name="remitente" value="<?php echo $remitente ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="transportista" class="col-sm-2 control-label">Transportista:</label>
                <div class="col-sm-10">
                    <input type="text" id="transportista" name="transportista" value="<?php echo $transportista ?>" class="form-control" tabindex="11" />
                </div>
            </div>

            <div class="form-group">
                <label for="oficina" class="col-sm-2 control-label">Oficina No:</label>
                <div class="col-sm-10">
                    <input type="text" id="oficina" name="oficina" value="<?php echo $oficina ?>" class="form-control" tabindex="9"  />
                </div>
            </div>

            <div class="form-group">
                <label for="direccion1" class="col-sm-2 control-label">Calle:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion1" name="direccion1" value="<?php echo $direccion1 ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>


            <div class="form-group">
                <label for="direccion2" class="col-sm-2 control-label">Número:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion2" name="direccion2" value="<?php echo $direccion2 ?>" class="form-control" tabindex="5"  autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion3" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-10">
                    <input type="text" id="direccion3" name="direccion3" value="<?php echo $direccion3 ?>" class="form-control" tabindex="6" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group" >
                <label for="ciudad" class="col-sm-2 control-label">Ciudad:</label>
                <div class="col-sm-10">
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad ?>" class="form-control" tabindex="10" />
                </div>
            </div>

            <div class="form-group">
                <label for="estado" class="col-sm-2 control-label">Estado:</label>
                <div class="col-sm-10">
                    <input type="text" id="estado" name="estado" value="<?php echo $estado ?>" class="form-control" tabindex="14" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="cp" class="col-sm-2 control-label">Codigo Postal:</label>
                <div class="col-sm-10">
                    <input type="text" id="cp" name="cp" value="<?php echo $cp ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="paquetes" class="col-sm-2 control-label">Número de paquetes:</label>
                <div class="col-sm-10">
                    <input type="text" id="paquetes" name="paquetes" value="<?php echo $paquetes ?>" class="form-control" tabindex="15" placeholder="máximo 30 caracteres" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="peso" class="col-sm-2 control-label">Peso total paquetes (Kg):</label>
                <div class="col-sm-10">
                    <input type="text" id="peso" name="peso" value="<?php echo $peso ?>" class="form-control" tabindex="4" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="tel1" class="col-sm-2 control-label">Mi telefono:</label>
                <div class="col-sm-10">
                    <input type="text" id="tel1" name="tel1" value="<?php echo $tel1 ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="tel2" class="col-sm-2 control-label">Mi Tel. Celular:</label>
                <div class="col-sm-10">
                    <input type="text" id="tel2" name="tel2" value="<?php echo $tel2 ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="atencion" class="col-sm-2 control-label">Atención a:</label>
                <div class="col-sm-10">
                    <input type="text" id="atencion" name="atencion" value="<?php echo $atencionA ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <!-- //datos generales -->

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las anomalias -->
<script src="<?php echo base_url();?>static/js/anomalias.js"></script>
