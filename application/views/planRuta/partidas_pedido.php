<article class="row">

    <div class="col-md-12">

        <a href="<?php echo base_url(); echo $this->session->regresar; ?>">
            <i class="fa fa-arrow-circle-left"></i>
            Regresar
        </a>

        <div class="table-responsive">
            <?php if (isset($partidas)):
            ?>
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
                    <?php foreach ($partidas as $partida):
                    ?>
                    <tr>
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
