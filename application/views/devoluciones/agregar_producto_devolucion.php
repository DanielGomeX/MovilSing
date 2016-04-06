<article class="row">

    <div class="col-md-8 col-md-offset-2">


        <!-- permite mantener los campos de captura ocultos mientras no se haya seleccionado ningún producto -->
        <?php if (isset($producto)):
        ?>
        <!-- TABLA DE PRODUCTO SELECCIONADO-->
        <div class="table-responsive">

            <h3>Producto seleccionado</h3>

            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            InvtId
                        </th>
                        <th>
                            Descr
                        </th>
                        <th>
                            Unidad
                        </th>
                        <th>
                            CantSol
                        </th>
                        <th>
                            CantSurt
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($producto as $registro):
                        ?>
                    <tr>
                        <td>
                            <?php echo $registro['InvtId']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Descr']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Unidad']; ?>
                        </td>
                        <td>
                            <?php echo $registro['CantSol']; ?>
                        </td>
                        <td>
                            <?php echo $registro['CantSurt']; ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <p class="texto-color-rojo">
                NOTA: SOLO SE RECIBE PRODUCTO EN BUENAS CONDICIONES, EMPAQUE ORIGINAL Y MULTIPLOS DE VENTA
            </p>
        </div>

        <!-- TABLA DE PRODUCTO EN ESPECIE-->
        <div class="table-responsive">

            <h3>Producto en especie asociado</h3>

            <!-- Si la variable clientes_planruta no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($producto_especie)):
            ?>
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            InvcNbr
                        </th>
                        <th>
                            Pedido
                        </th>
                        <th>
                            Cantidad
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($producto_especie as $registro):
                        ?>
                    <tr>
                        <td>
                            <?php echo $registro['InvcNbr']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Pedido']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Cantidad']; ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>

            <p class="texto-color-rojo">
                NOTA: DEBE RETIRAR AL CLIENTE TODOS LOS PRODUCTOS QUE FUERON DADOS EN ESPECIE
            </p>
            <?php
            endif;
            ?>
        </div>

        <!-- FORMULARIO PARA AGREGAR CANTIDAD A DEVOLVER -->
        <form id="frmAgregarProductoDevolver" action='<?php echo base_url(); ?>DevolucionesController/registrarProductoDevolucion' method="post">

            <div class="form-group">
                <?php if (isset($articulo)): ?>
                    <input type="hidden" id="articulo" name="articulo" value="<?php echo $articulo ?>" class="form-control"/>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad a devolver:</label>
                <?php if (isset($cantidadSurtida)): ?>
                    <input type="hidden" id="cantSurtida" value="<?php echo $cantidadSurtida ?>" />
                    <input type="text" id="cantidad" name="cantidad" value="<?php echo $cantidadSurtida ?>" class="form-control" autocomplete="off" tabindex="1"  />
                <?php endif ?>
            </div>

<!--             <div class="form-group">
                    <select class="form-control" name="causa" >
                      <option selected disabled value="">Seleccione una causa</option>

                        <?php foreach ($listaNotasCredito as $registro): ?>

                            <option value="<?php echo  $registro['IdCausaNota'] ?>"><?php echo  $registro['Causa'] ?></option>

                        <?php endforeach; ?>
                    </select>
            </div> -->

            <div class="form-group">
                <label for="motivo">Motivo de la devolución del producto:</label>
                <input type="text" id="motivo" name="motivo" class="form-control" autocomplete="off" tabindex="2"  />
                <?php echo form_error('motivo'); ?>
            </div>

            <div>
                <button type="submit" id="btnAgregar" class="btn btn-warning" tabindex="3">
                    <i class="fa fa-search"></i>
                    Agregar
                </button>
            </div>
        </form>


        <!-- permite mantener los campos de captura ocultos mientras no se haya seleccionado ningún producto -->
        <?php
        endif;
        ?>

            <a class="btn btn-default" href="<?php echo base_url(); ?>devolucionEditar/<?php echo $_SESSION['devolucion']; ?>" role="button">
                <i class="fa fa-arrow-circle-left"></i>
                    Regresar
            </a>

            <a class="btn btn-default" href="<?php echo base_url(); ?>devolucionEditar/<?php echo $_SESSION['devolucion']; ?>" role="button">
                <i class="fa fa-plus"></i>
                    Agregar todos los productos
            </a>


        <h2 class="texto-centrado">Producto(s) contenidos en la Factura a Devolver </h2>

        <!-- TABLA QUE MUESTRA LOS PRODUCTOS QUE CONTENIA LA FACTURA -->
        <div class="table-responsive">

            <!-- Si la variable clientes_planruta no esta vacia, mostramos la tabla con los datos -->
            <?php if (isset($productos_factura)):
            ?>
            <table id="tbProductosFacturaDevolucion" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            Factura
                        </th>
                        <th>
                            Clve
                        </th>
                        <th>
                            Descripción
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($productos_factura as $registro):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url() ?>DevolucionesController/mostrarDatosProductoDevolver/<?php echo $registro['InvtId'] ?>">Seleccionar</a>
                        </td>
                        <td>
                            <?php echo $registro['InvcNbr']; ?>
                        </td>
                        <td>
                            <?php echo $registro['InvtId']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Descr']; ?>
                        </td>
                        <td>
                            <?php echo $registro['CantSurtida']; ?>
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


<!-- Cargamos el sript que se usa para las devoluciones -->
<script src="<?php echo base_url();?>static/js/devoluciones.js"></script>