<article class="row">

    <div class="col-md-12">

        <div>
            <a class="btn btn-default" role="button" href="<?php echo base_url(); ?>agregar">
                <i class="fa fa-plus"></i>
                Agregar Partida
            </a>
            <a class="btn btn-default" role="button" href="<?php echo base_url(); ?>resumen">
                <i class="fa fa-check"></i>
                Finalizar Pedido
            </a>
        </div>

        <div>
            <?php echo "Partidas: ".$total_partidas;  ?>
        </div>
        <div>
            <?php echo "Importe: ".'$'.number_format(round($subtotal, 2),2); ?>
        </div>

        <!-- TABLA DE PRODUCTOS REGISTRADOS -->
        <div class="table-responsive">

            <?php if (isset($partidas_pedido)):
            ?>

            <table id="tbPartidas" class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            SKU
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>
                            $ Unitario
                        </th>
                        <th>
                            Descuento
                        </th>
                        <th>
                            $ Descuento
                        </th>
                        <th>
                            Importe
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($partidas_pedido as $partida):
                    ?>
                    <tr>
                        <td>
                            <a class="btn btn-danger" role="button" href="<?php echo base_url(); ?>eliminar/<?php echo $partida['ID']; ?>">
                                <i class="fa fa-trash-o"></i>
                                Eliminar
                            </a>
                        </td>
                        <td>
                            <?php echo $partida['SKU']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($partida['Descripcion']); ?>
                        </td>
                        <td>
                            <?php echo $partida['Cantidad']; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($partida['PrecioUnitario'],2); ?>
                        </td>
                        <td>
                            <?php echo number_format($partida['Descuento']).'%'; ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($partida['PrecioDesc'],2); ?>
                        </td>
                        <td>
                            <?php echo '$'.number_format($partida['Importe'],2); ?>
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
