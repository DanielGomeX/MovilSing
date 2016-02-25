<article class="row">

    <div class="col-md-12">

        <h2>Partidas en Back Order</h2>
        <!-- Guardamos en una vaiable de sesion la url que manda llamar a las partidas, para que
        el link regresar nos mande nuevamente a esta pantalla -->
        <?php $_SESSION['regresar']=$this->uri->uri_string(); ?>

        <div class="tabla-responsive">
            <?php if (isset($backOrder)):
            ?>
            <table id="tbBackOrder" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>
                            Pedido
                        </th>
                        <th>
                            FechaOrden
                        </th>
                        <th>
                            Orden
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Clave
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Cant. Ordenada
                        </th>
                        <th>
                            Cant. Facturada
                        </th>
                        <th>
                            Cant. BackOrder
                        </th>
                        <th>
                            Precio Vta
                        </th>
                        <th>
                            Importe
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($backOrder as $registro):
                    ?>
                    <tr>
                        <td>
                            <?php echo $registro['Pedido']; ?>
                        </td>
                        <td>
                            <?php echo $registro['FechaOrden']; ?>
                        </td>
                        <td>
                            <?php echo $registro['Orden']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['Cliente']); ?>
                        </td>
                        <td>
                            <?php echo $registro['Nombre']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['Clave']); ?>
                        </td>
                        <td>
                            <?php echo $registro['Descripcion']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['CantOrdenada']); ?>
                        </td>
                        <td>
                            <?php echo $registro['CantFacturada']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['CantBackOrder']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['PrecioVenta']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($registro['Importe']); ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->