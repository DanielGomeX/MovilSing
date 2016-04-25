<!-- Formulario Modal utilizado para capturar la razon por la cual se requiere realizar la devolución -->
<div class="modal fade" id="frmModalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Enviar a supervisor </h4>
                </div>
                <div class="modal-body">

                    <form id="frmCambiarStatus" class="form-horizontal" method="post" action="<?php base_url() ?>/AnomaliasController/cambiarStatus">

                        <label for="observaciones">Escriba el motivo por el cual se debería de autorizar </label>
                        <textarea class="form-control" name="observaciones"></textarea>
                        <input type="hidden" name="nuevoStatus" value="REV.SUPERVISOR">

                        <br>

                         <button type="submit" class="btn btn-warning">
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

        <h2 class="texto-centrado">Datos generales de la Anomalia</h2>

        <!-- MENU DE NAVEGACION -->
        <div class="form-group">
            <ul class="nav nav-pills nav-justified ">
                <?php if ($status=='CAPTURA' || $status=='REV.VENDEDOR'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>AnomaliasController/agregarProductoParaDevolucion"><i class="fa fa-plus"></i> Agregar Producto(s)</a></li>
                <?php elseif ($status=='POR ENVIAR' || $status=='AUTORIZADO'): ?>
                    <li role="presentation"><a href="<?php echo base_url() ?>AnomaliasController/obtenerDatosEnvioAanomalia"><i class="fa fa-truck"></i> Enviar a Ags</a></li>

                    <li role="presentation"><a href="<?php echo base_url() ?>AnomaliasController/mostrarPaquetesEnvio"><i class="fa fa-truck"></i> Enviar a Ags Prueba</a></li>
                <?php endif; ?>

                <!-- Si el arreglo "productos_devolucion" contiene registros, y la variable status es igual a "CAPTURA" mostramos el boton de Enviar a Supervisor-->
                <?php if (count($productos_devolucion)>0 && ($status=="CAPTURA")  ):
                 ?>
                    <li role="presentation"><a id="btnSupervisor" href="#"><i class="fa fa-user" ></i> Enviar a Supervisor </a></li>
                <?php
                endif;
                 ?>

                    <li role="presentation"><a href="<?php echo base_url() ?>anomalias"><i class="fa fa-arrow-circle-left"></i>Mis Anomalias</a></li>
            </ul>
        </div>

        <!-- FROMULARIO PARA MOSTRAR LOS DATOS GENERALES DE LA FACTURA -->
        <form class="form-horizontal" method="post" >

            <div class="form-group">
                <label for="anomalia" class="col-sm-2 control-label">Anomalia No.:</label>
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

            <div class="form-group">
                <label for="subTotal" class="col-sm-2 control-label">Importe antes de impuestos:</label>
                <div class="col-sm-10">
                    <input type="text" id="subTotal" name="subTotal" value="<?php echo '$'.number_format($subTotal,2) ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>

            <!--
            <div class="form-group">
                <label for="totIva" class="col-sm-2 control-label">Iva:</label>
                <div class="col-sm-10">
                    <input type="text" id="totIva" name="totIva" value="<?php echo '$'.number_format($totIva,2) ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>
            -->

            <div class="form-group">
                <label for="causa" class="col-sm-2 control-label">Causa:</label>
                <div class="col-sm-10">
                    <input type="text" id="causa" name="causa" value="<?php echo ($causa) ?>" class="form-control" tabindex="15" autocomplete="off"/>
                </div>
            </div>


            <!-- sirve para saber que cual es elstatus actual de la factura para devolución -->
            <input type="hidden" id="status" name="status" value="<?php echo $status ?>" >

        </form>

    </div><!-- //columna -->
</article><!-- //renglon -->



<article class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="table-responsive">

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
                            Motivo
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
                                <a href="<?php echo base_url() ?>AnomaliasController/eliminarProductoParaDevolucion/<?php echo $registro['IdAnomaliaDetalle'] ?>">Eliminar</a>
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
                            <?php echo $registro['Observaciones']; ?>
                        </td>
                    </tr>

                    <?php
                    endforeach;
                    ?>

                </tbody>

            </table>

        </div><!-- //contenedor de la tabla -->

    </div><!-- //columna -->
</article><!-- //renglon -->


<!-- Cargamos el sript que se usa para las anomalias -->
<script src="<?php echo base_url();?>static/js/anomalias.js"></script>
