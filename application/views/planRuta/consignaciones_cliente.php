<article class="row">

    <div class="col-md-12">

        <a href="<?php echo base_url(); ?>resumen">
            <i class="fa fa-arrow-circle-left"></i>
            Regresar
        </a>

        <hr>

        <div class="table-responsive">
            <?php
            if (isset($consignaciones)):
                ?>
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>
                            Consignacion
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Atencion
                        </th>
                        <th>
                            Direccion
                        </th>
                        <th>
                            Colonia
                        </th>
                        <th>
                            Ciudad
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Telefono
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consignaciones as $consignacion):
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PedidosController/cambiarConsignacion/<?php echo $consignacion['Consignacion']; ?>">
                                <i class="fa fa-exchange"></i>
                                <?php echo $consignacion['Consignacion']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $consignacion['Cliente']; ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Nombre']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Atencion']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Direccion']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Ciudad']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Estado']); ?>
                        </td>
                        <td>
                            <?php echo utf8_encode($consignacion['Estado']); ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Telefono']; ?>
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
