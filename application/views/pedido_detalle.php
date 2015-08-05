<article class="container">

    <div>
     <a href="<?php echo base_url(); ?>agregar">Agregar Partida(s)</a> |
     <a href="<?php echo base_url(); ?>resumen">Finalizar Pedido</a>
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
                    PrecioUnitario
                </th>
                <th>
                    Descuento
                </th>
                <th>
                    PrecioDesc
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
                    <a href="<?php echo base_url(); ?>eliminar/<?php echo $partida['ID']; ?>">Eliminar</a>
                </td>
                <td>
                    <?php echo ($partida['SKU']); ?>
                </td>
                <td>
                    <?php echo ($partida['Descripcion']); ?>
                </td>
                <td>
                    <?php echo ($partida['Cantidad']); ?>
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
