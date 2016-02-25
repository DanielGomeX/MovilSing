<article class="row">

    <div class="col-md-4 col-md-offset-2">

        <h2>Consultar Existencias</h2>


        <!-- FORMULARIO PARA BUSQUEDA DE PRODUCTOS -->
        <form id="frmBuscar" action='<?php echo base_url(); ?>buscarExistencia' method="post">
            <div class="form-group">
                <input class="form-control" type="text" id="descripcion" name="descripcion" autocomplete="off" placeholder="Breve descripción de lo que desea buscar"/>
                <?php echo form_error('descripcion'); ?>
            </div>
            <button class="btn btn-warning" id="btnBuscar" type="submit">
                <i class="fa fa-search"></i>
                Buscar Producto
            </button>
        </form>

    </div><!-- //columna -->

</article><!-- //renglon -->

<article class="row">

    <div class="col-md-10">
        <!-- TABLA DE PRODUCTOS ENCONTRADOS -->
        <div class="table-responsive">
            <?php if (isset($productos)):
            ?>
            <!-- El objeto id=tbProductos ejecuta un javaScript (ver archivo llamado funciones.js) -->
            <table class="table table-striped table-condensed" id="tbProductos">
                <thead>
                    <tr>
                        <th>
                            Clave
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Existencia
                        </th>
                        <th>
                            UnidadVenta
                        </th>
                        <th>
                            MultiploVenta
                        </th>
                        <th>
                            PrecioLista
                        </th>
                        <th>
                            Familia
                        </th>
                        <th>
                            Linea
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto):
                    ?>
                    <tr>
                        <td>
                            <?php echo $producto['Clave']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Descripcion']); ?>
                        </td>
                        <td>
                            <?php echo $producto['Existencia']; ?>
                        </td>
                        <td>
                            <?php echo $producto['UnidadVenta']; ?>
                        </td>
                        <td>
                            <?php echo $producto['MultiploVenta']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($producto['PrecioLista']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Familia']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($producto['Linea']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>

    </div>
</article>