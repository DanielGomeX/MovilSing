<article class="contenido">
    <a href="<?php echo base_url(); ?>resumen">Regresar</a>
    <hr>
    <div class="table-responsive">
        <?php
        if (isset($consignaciones)) {
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
                    <?php
                    foreach ($consignaciones as $consignacion):
                        ?>
                    <tr>
                        <td>
                            <a href="<?php echo base_url(); ?>PedidosController/cambiarConsignacion/<?php echo $consignacion['Consignacion']; ?>"><?php echo $consignacion['Consignacion']; ?></a>

                        </td>
                        <td>
                            <?php echo $consignacion['Cliente']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Nombre']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Atencion']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Direccion']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Ciudad']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Estado']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Estado']; ?>
                        </td>
                        <td>
                            <?php echo $consignacion['Telefono']; ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>

                </thead>
            </table>
            <?php
        }

        ?>
    </div>
</article>
