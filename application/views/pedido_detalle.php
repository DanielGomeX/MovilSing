<article class="container">

    <div>
        <a class="btn btn-default" role="button" href="<?php echo base_url(); ?>agregar">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Agregar Partida
        </a>
        <a class="btn btn-default" role="button" href="<?php echo base_url(); ?>resumen">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            Finalizar Pedido
        </a>
    </div>
    <br>

    <div>
        <?php echo "Partidas: ".$total_partidas;  ?>
    </div>
    <div>
        <?php echo "Importe: ".'$'.number_format(round($subtotal, 2),2); ?>
    </div>

    <div class="table-responsive">
       <?php
       if (isset($partidas_pedido)) {
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
                <?php
                foreach ($partidas_pedido as $partida):
                    ?>
                <tr>
                    <td>
                        <a class="btn btn-danger" role="button" href="<?php echo base_url(); ?>eliminar/<?php echo $partida['ID']; ?>">
                           <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
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
        <?php endforeach; ?>
    </tbody>
</table>
<?php }  ?>
</div>

</article>
