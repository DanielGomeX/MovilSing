<!-- Formulario Modal -->
<div class="modal fade" id="frmModalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Enviar a supervisor </h4>
                </div>
                <div class="modal-body">

                    <!-- FORMULARIO -->
                    <form id="frmCambiarStatus" class="form-horizontal" method="post" action="<?php base_url() ?>/DevolucionesController/cambiarStatus">

                        <input type="hidden" name="nuevoStatus" value="REV.SUPERVISOR">
                        <label for="observaciones">Escriba el motivo por el cual se debería de autorizar la devolución / reclamación </label>
                        <textarea class="form-control" name="observaciones"></textarea>

                     <!-- este objeto ejecuta un javascript, ver script llamado prospectos.js -->
                     <button type="submit" id="btnEnviar" class="btn btn-info">
                        <i class="fa fa-save"></i>
                        Enviar
                    </button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- //Modal -->


<article class="row">

    <div class="col-md-8 col-md-offset-2">

        <h2 class="texto-centrado">Datos de la Devolución</h2>

        <!-- MENU DE NAVEGACION -->
        <div class="form-group">
            <ul class="nav nav-pills nav-justified ">
                <?php if ($status=='CAPTURA' || $status=='REV.VENDEDOR'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>DevolucionesController/agregarProductoParaDevolucion"><i class="fa fa-plus"></i> Agregar Producto(s)</a></li>
                <?php elseif ($status=='POR ENVIAR'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>DevolucionesController/obtenerDatosEnvioAanomalia"><i class="fa fa-truck"></i> Enviar a Ags</a></li>
                <?php endif; ?>

                <!-- Si el arreglo "productos_devolucion" contiene registros, y la variable status es igual a "CAPTURA" mostramos el boton de Enviar a Supervisor-->
                <?php if (count($productos_devolucion)>0 && ($status=="CAPTURA")  ):
                 ?>
                    <li role="presentation"><a id="btnSupervisor" ><i class="fa fa-user"></i> Enviar a Supervisor </a></li>
                <?php
                endif;
                 ?>

                    <li role="presentation"><a href="<?php echo base_url() ?>devoluciones"><i class="fa fa-arrow-circle-left"></i> Mis Devoluciones</a></li>
            </ul>
        </div>

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form class="form-horizontal" method="post" action="<?php echo base_url() ?>">

            <div class="form-group">
                <label for="anomalia" class="col-sm-2 control-label">Devolución:</label>
                <div class="col-sm-10">
                    <input type="text" id="anomalia" name="anomalia" value="<?php echo $anomalia ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div>

            <div class="form-group" >
                <label for="invcNbr" class="col-sm-2 control-label">Factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="invcNbr" name="invcNbr" value="<?php echo $invcNbr ?>" class="form-control" tabindex="11" />
                </div>
            </div>

            <div class="form-group">
                <label for="invcDate" class="col-sm-2 control-label">Fecha factura:</label>
                <div class="col-sm-10">
                    <input type="text" id="invcDate" name="invcDate" value="<?php echo $invcDate ?>" class="form-control" tabindex="9"  />
                </div>
            </div>

<!--             <div class="form-group">
                <label for="shipperid" class="col-sm-2 control-label">Embarque:</label>
                <div class="col-sm-10">
                    <input type="text" id="shipperid" name="shipperid" value="<?php echo $shipperid ?>" class="form-control" tabindex="1" autocomplete="off" />
                </div>
            </div> -->


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

<!--             <div class="form-group" >
                <label for="folio" class="col-sm-2 control-label">Folio:</label>
                <div class="col-sm-10">
                    <input type="text" id="folio" name="folio" value="<?php echo $folio ?>" class="form-control" tabindex="10" />
                </div>
            </div> -->

<!--             <div class="form-group">
                <label for="status" class="col-sm-2 control-label">Status:</label>
                <div class="col-sm-10">
                    <input type="text" id="status" name="status" value="<?php echo $status ?>" class="form-control" tabindex="14" autocomplete="off"/>
                </div>
            </div>
 -->
            <input type="hidden" id="status" name="status" value="<?php echo $status ?>" class="form-control" tabindex="14" autocomplete="off"/>

            <div class="form-group">
                <label for="subTotal" class="col-sm-2 control-label">Subtotal:</label>
                <div class="col-sm-10">
                    <input type="text" id="subTotal" name="subTotal" value="<?php echo '$'.number_format($subTotal,2) ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="totIva" class="col-sm-2 control-label">Iva:</label>
                <div class="col-sm-10">
                    <input type="text" id="totIva" name="totIva" value="<?php echo '$'.number_format($totIva,2) ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-10">
                    <input type="hidden" id="enAlma" name="enAlma" value="<?php echo $enAlma ?>" class="form-control" tabindex="4" autocomplete="off"/>
                </div>
            </div>


<!--             <div class="form-group">
                <label for="fecha" class="col-sm-2 control-label">Fecha devolución:</label>
                <div class="col-sm-10">
                    <input type="text" id="fecha" name="fecha" value="<?php echo $fecha ?>" class="form-control" tabindex="4" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="contacto" class="col-sm-2 control-label">Contacto:</label>
                <div class="col-sm-10">
                    <input type="text" id="contacto" name="contacto" value="<?php echo $contacto ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Telefono:</label>
                <div class="col-sm-10">
                    <input type="text" id="telefono" name="telefono" value="<?php echo $telefono ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" id="email" name="email" value="<?php echo $email ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
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
            </div>

            <div class="form-group" >
                <label for="firmaCteAutorizaEnvio" class="col-sm-2 control-label">Firma Cte. Autoriza Envio:</label>
                <div class="col-sm-10">
                    <input type="text" id="firmaCteAutorizaEnvio" name="firmaCteAutorizaEnvio" value="<?php echo $firmaCteAutorizaEnvio ?>" class="form-control" tabindex="7" />
                </div>
            </div>

 -->

<!--
            <div class="form-group" >
                <label for="emailFirmaCteEnvio" class="col-sm-2 control-label">Email Firma Cte. Envio:</label>
                <div class="col-sm-10">
                    <input type="text" id="emailFirmaCteEnvio" name="emailFirmaCteEnvio" value="<?php echo $emailFirmaCteEnvio ?>" class="form-control" tabindex="7" />
                </div>
            </div> -->


<!--             <div class="form-group" >
                <label for="transportista" class="col-sm-2 control-label">Entregado por:</label>
                <div class="col-sm-10">
                    <input type="text" id="transportista" name="transportista" value="<?php echo $transportista ?>" class="form-control" tabindex="7" />
                </div>
            </div>

            <div class="form-group" >
                <label for="solicitoGuias" class="col-sm-2 control-label">Solicito Guias:</label>
                <div class="col-sm-10">
                    <input type="text" id="solicitoGuias" name="solicitoGuias" value="<?php echo $solicitoGuias ?>" class="form-control" tabindex="7" />
                </div>
            </div>

            <div class="form-group" >
                <label for="fechaSolGuias" class="col-sm-2 control-label">Fecha Solicitud Guias:</label>
                <div class="col-sm-10">
                    <input type="text" id="fechaSolGuias" name="fechaSolGuias" value="<?php echo $fechaSolGuias ?>" class="form-control" tabindex="7" />
                </div>
            </div>
-->

        <h3 class="texto-centrado">Productos agregados para Devolcuión</h3>

        <!-- TABLA DE PRODUCTOS AGREGADOS PARA DEVOLUCION -->
        <div class="table-responsive">
            <!-- Si la variable productos_devolucion no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($productos_devolucion) && count($productos_devolucion)>0):
            ?>
            <table id="tbProductosDevolucion" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            Clve
                        </th>
                        <th>
                            Descripción
                        </th>
                        <th>
                            Unidad
                        </th>
                        <th>
                            Pzas
                        </th>
                        <th>
                            Precio
                        </th>
                        <th>
                            Subtotal
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Observaciones
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($productos_devolucion as $registro):
                        ?>
                    <tr>
                        <td>
                            <!-- si el status de la devolución es CAPTURA o REV.VENDEDOR si se podran eliminar productos agregados previamente -->
                            <?php if ($status=='CAPTURA' || $status=='REV.VENDEDOR'): ?>
                                <a href="<?php echo base_url() ?>DevolucionesController/eliminarProductoParaDevolucion/<?php echo $registro['IdAnomaliaDetalle'] ?>">Eliminar</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $registro['InvtID']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Descr']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Unidad']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Pzas']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($registro['Precio'],2); ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($registro['Subtotal'],2); ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($registro['Total'],2); ?>
                        </td>
                        <td>
                            <?php echo $registro['Observaciones']; ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <?php
            endif;
            ?>
        </div>

            <!-- //datos generales -->

        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
