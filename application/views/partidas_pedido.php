<article class="container">

    <a href="<?php echo base_url(); echo $_SESSION['regresar']; ?>">Regresar</a>
    <div class="table-responsive">
        <?php if (isset($partidas)) { ?>
        <table id="tbPartidas" class="table table-striped table-condensed">
            <thead>
                <tr>
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
                <?php foreach ($partidas as $partida): ?>
                <tr>
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
    <?php } ?>
</div>

</article>
