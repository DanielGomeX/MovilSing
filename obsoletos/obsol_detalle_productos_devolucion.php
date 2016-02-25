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
                    <label for="observaciones">Observaciones </label>
                    <textarea class="form-control" name="observaciones"></textarea>

                    <div id="msj">
                        <!-- AQUI SE MUESTRA EL MENSAJE DE VALIDACION CORRESPONDIENTE -->
                    </div>

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

        <h2>Productos agregados para Devolcuión</h2>

        <div class="form-group">
            <a class="btn btn-warning" role="button" href="<?php echo base_url(); ?>DevolucionesController/agregarProductoParaDevolucion">
                <i class="fa fa-users"></i>
                Agregar producto
            </a>

            <!-- Si el arreglo "productos_devolucion" contiene registros, y la variable status es igual a "CAPTURA" mostramos el boton -->
            <?php if (count($productos_devolucion)>0 && ($status=="CAPTURA")  ):
             ?>
                <a class="btn btn-warning" role="button" id="btnSupervisor" >
                    <i class="fa fa-close"></i>
                    Enviar a Supervisor
                </a>
            <?php
            endif;
             ?>

            <a class="btn btn-warning" role="button" href="<?php echo base_url() ?>DevolucionesController/mostrarDatosDevolucion/<?php echo $_SESSION['devolucion'] ?>">
                <i class="fa fa-close"></i>
                Regresar
            </a>
        </div>

        <!-- TABLA DE CLIENTES EN PLAN DE RUTA DEL DIA -->
        <div class="table-responsive">
            <!-- Si la variable clientes_planruta no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($productos_devolucion)):
            ?>
            <table id="tbClientesPlanRuta" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            No. Causa
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
                            <a href="<?php echo base_url() ?>DevolucionesController/eliminarProductoParaDevolucion/<?php echo $registro['IdAnomaliaDetalle'] ?>">Eliminar</a>
                        </td>
                        <td>
                            <?php echo $registro['IdCausa']; ?>
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
                            <?php echo $registro['Precio']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Subtotal']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Total']; ?>
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

    </div><!-- //columna -->

</article><!-- //renglon -->

<!-- Cargamos el sript que se usa para los prospectos -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>