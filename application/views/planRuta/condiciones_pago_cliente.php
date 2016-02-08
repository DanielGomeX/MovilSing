<article class="row">

    <div class="col-md-12">

        <a href="<?php echo base_url(); ?>resumen">
            <i class="fa fa-arrow-circle-left"></i>
            Regresar
        </a>

        <hr>

            <div>
                <p><strong>NOTA:</strong> Al cambiar la condición de crédito, el pedido será RETENIDO en automático
                    independientemente de las otras condiciones de crédito que le apliquen.
                </p>
            </div>

        <div class="table-responsive">
            <?php
            if (isset($condicionesPago)):
                ?>
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Plazo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($condicionesPago as $condicion):
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PlanRutaController/cambiarCondicionPago/<?php echo $condicion['TermsId']; ?>">
                                <i class="fa fa-exchange"></i>
                                <?php echo $condicion['TermsId']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $condicion['Descr']; ?>
                        </td>
                    </tr>
                    <?php endforeach;
                    ?>
                </tbody>
            </table>
            <?php endif;
            ?>

            <div>
                <p><strong>NOTA:</strong> Al cambiar la condición de crédito, el pedido será RETENIDO en automático
                    independientemente de las otras condiciones de crédito que le apliquen.
                </p>
            </div>
        </div>

    </div><!-- //columna -->

</article><!-- //renglon -->
