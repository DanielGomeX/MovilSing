
<!-- Formulario Modal para buscar por número de factura  -->
<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar Factura</h4>
            </div>

            <div class="modal-body">
                <!-- FORMULARIO PARA LA BUSQUEDA DE FACTURA -->
                <form id="frmBuscaFactura" class="form-inline" method="post" action="<?php base_url() ?>DevolucionesController/buscarFactura">
                    <div class="form-group" >
                        <label for="txtBuscar">Número de factura: </label>
                        <input type="text" class="form-control" id="txtBuscar" name="txtBuscar" autocomplete="off" tabindex="1"/>
                    </div>

                    <button id="btnBuscar" class="btn btn-warning" tabindex="2">
                        <i class="fa fa-search"></i>
                        Buscar
                    </button>

                    <div id="msj">
                        <!-- AQUI SE MUESTRA EL MENSAJE DE VALIDACION CORRESPONDIENTE -->
                    </div>

                </form>
             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!-- //Modal -->


<!-- Formulario Modal para buscar las facturas del cliente -->
<div class="modal fade" id="modalBuscarFacturaPorCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar factura por número de cliente:</h4>
            </div>

            <div class="modal-body">
                <!-- FORMULARIO PARA LA BUSQUEDA DE FACTURA -->
                <form id="frmBuscaFactura" class="form-inline" method="post" >
                    <div class="form-group" >
                        <label for="txtBuscar">Número de cliente: </label>
                        <input type="text" class="form-control" id="txtBuscarPorCliente" autocomplete="off" tabindex="1"/>
                    </div>

                    <!-- este objeto ejecuta un javascript, ver script llamado devoluciones.js -->
                    <button id="btnBuscarFacturas" class="btn btn-warning" tabindex="2">
                        <i class="fa fa-search"></i>
                        Buscar
                    </button>
                    <br>
                    <p><strong>AVISO:</strong>En caso de encontrarse facturas, solo se mostrarán las del último año a partir de hoy.</p>

                </form>

                <br>
                <div class="table-responsive">
                      <table class="table table-striped table-condensed" id="tbFacturasCliente">
                        <!--
                             esta parte se completa con el código que regresa la consulta ajax programada en el botón:
                            btnBuscarFacturas dentro del archivo script llamado devolucionesjs
                        -->
                      </table>
                </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!-- //Modal -->


<!-- Formulario Modal para buscar las facturas del cliente que contienen un producto en específico-->
<div class="modal fade" id="modalBuscarPorProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar por producto por cliente:</h4>
            </div>

            <div class="modal-body">
                <!-- FORMULARIO PARA LA BUSQUEDA DE FACTURA -->
                <form id="frmBuscarPorProducto" class="form-group" method="post" >

                    <div class="form-group" >
                        <label for="txtCliente">Número de cliente: </label>
                        <input type="text" class="form-control" id="txtCliente" autocomplete="off" tabindex="1" class="form-control"/>
                    </div>

                    <div class="form-group" >
                        <label for="txtProducto">clave de producto: </label>
                        <input type="text" class="form-control" id="txtProducto" autocomplete="off" tabindex="2" class="form-control"/>
                    </div>

                    <div class="form-group" >
                        <label for="txt" class="col-sm-2 control-label">Factura:</label>
                        <div class="col-sm-10">
                            <input type="text" id="txt" name="txt" class="form-control" />
                        </div>
                    </div>

                    <!-- este objeto ejecuta un javascript, ver script llamado devoluciones.js -->
                    <button id="btnBuscarPorProductoCliente" class="btn btn-warning" tabindex="3">
                        <i class="fa fa-search"></i>
                        Buscar
                    </button>
                    <br>
                    <p><strong>AVISO:</strong>En caso de encontrarse facturas, solo se mostrarán las del último año a partir de hoy.</p>

                </form>

                <br>
                <div class="table-responsive">
                      <table class="table table-striped table-condensed" id="tbPorProductoCliente">
                        <!--
                             esta parte se completa con el código que regresa la consulta ajax programada en el botón:
                            btnBuscarFacturas dentro del archivo script llamado devolucionesjs
                        -->
                      </table>
                </div>

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


        <h2 class="texto-centrado">Devoluciones </h2>

        <div class="form-group">

            <!-- este objeto ejecuta un javascript, ver script llamado devoluciones.js -->
            <a class="btn btn-warning" role="button" id="btnBuscarPorFactura">
                <i class="fa fa-file-o"></i>
                Buscar factura por número
            </a>

            <!-- este objeto ejecuta un javascript, ver script llamado devoluciones.js -->
            <a class="btn btn-warning" role="button" id="btnBuscarPorCliente">
                <i class="fa fa-user"></i>
                Buscar factura por cliente
            </a>


            <!-- este objeto ejecuta un javascript, ver script llamado devoluciones.js -->
            <a class="btn btn-warning" role="button" id="btnBuscarPorProducto">
                <i class="fa fa-user"></i>
                Buscar factura por producto cliente
            </a>

        </div>

        <?php
        //arreglo con los status permitidos para poder realizar una eliminación
        $status_eliminar = array("CAPTURA", "NO AUTORIZADO");
        ?>


        <!-- TABLA DASHBOARD DE DEVOLUCIONES -->
        <div class="table-responsive">
            <!-- Si la variable devoluciones no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($devoluciones)):
            ?>
            <table id="tbDevoluciones" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            No. Devolcuión
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Importe
                        </th>
                        <th>
                            Status
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($devoluciones as $registro):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>devolucionEditar/<?php echo $registro['IdAnomalia']; ?>"><?php echo $registro['IdAnomalia']; ?></a>
                        </td>
                        <td>
                            <?php echo $registro['CustID']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Cliente']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($registro['Importe'],2)  ?>
                        </td>
                        <td>
                            <?php echo $registro['Status']; ?>
                        </td>
                        <td>
                            <!-- Si el status del prospecto es igual a cualquiera de los status contenidos en el arreglo "status_eliminar"
                             entonces, mostramos el link para poder eliminarlos -->
                            <?php if (in_array($registro['Status'], $status_eliminar) ):
                            ?>
                            <a href="<?php echo base_url(); ?>devolucionEliminar/<?php echo $registro['IdAnomalia']; ?>">
                                Eliminar
                            </a>
                            <?php endif;
                            ?>
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

<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>
